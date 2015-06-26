<?php
namespace backend\controllers;

use common\models\Arrangement;
use common\models\Product;
use common\models\Setting;
use common\models\LoginForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 * Site controller.
 * It is responsible for displaying static pages, and logging users in and out.
 */
class SiteController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'lock-screen', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isset(Yii::$app->request->post()['arrangementProduct'])) {
            $idList = explode(',', Yii::$app->request->post()['arrangementProduct']);
            foreach ($idList as $index => $id) {
                $arrangementObject = Arrangement::findOne(['content_id' => $id, 'content_type' => Arrangement::TYPE_PRODUCT]);
                if($arrangementObject) {
                    $arrangementObject->deleted = 0;
                    $arrangementObject->sorting = $index + 1;
                }
                else {
                    $arrangementObject = new Arrangement();
                    $arrangementObject->content_type = Arrangement::TYPE_PRODUCT;
                    $arrangementObject->content_id = $id;
                    $arrangementObject->sorting = $index + 1;
                }
                $arrangementObject->save(false);
            }
            $arrangementObjects = Arrangement::findAll(['content_type'=>Arrangement::TYPE_PRODUCT]);
            foreach ($arrangementObjects as $object) {
                if(!in_array($object->content_id, $idList)){
                    $object->deleted = 1;
                    $object->save(false);
                }
            }
            $this->redirect('index');
        }
        else {
            $productArrangements = Product::find()->innerJoin('tbl_arrangement', 'tbl_product.id = tbl_arrangement.content_id')
                ->where(["tbl_product.deleted" => 0, "tbl_arrangement.deleted" => 0, "content_type" => Arrangement::TYPE_PRODUCT])
                ->orderBy('sorting')->all();
            $idList = [];
            foreach ($productArrangements as $index => $product) {
                array_push($idList, $product->id);
            }

            $productSuggestion = Product::find()->where(["AND", "deleted = 0", ["NOT IN", "id", $idList]])->orderBy('published_date DESC')->all();
            return $this->render('index', [
                'products' => $productArrangements,
                'productSuggestion' => $productSuggestion,
            ]);
        }
    }

    /**
     * Logs in the user if his account is activated,
     * if not, displays standard error message.
     *
     * @param string $previous
     * @return string|\yii\web\Response
     */
    public function actionLogin($previous = '')
    {
        if (!Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }

        // Set the special layout
        $this->layout = 'full';

        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if "login with email" is true we instantiate LoginForm in "lwe" scenario
        $lwe ? $model = new LoginForm(['scenario' => 'lwe']) : $model = new LoginForm() ;

        // everything went fine, log in the user
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            if(!empty($previous)){
                return $this->redirect($previous);
            }
            else{
                return $this->goBack();
            }
        } 
        // errors will be displayed
        else 
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param string $previous
     * @return string|\yii\web\Response
     */
    public function actionLockScreen($previous)
    {
        // Set the special layout
        $this->layout = 'full';

        if(isset(Yii::$app->user->identity->username)){
            // save current username
            $username = Yii::$app->user->identity->username;
            // force logout
            Yii::$app->user->logout();
            // render form lockscreen
            $model = new LoginForm();
            $model->username = $username;    //set default value
            return $this->render('lockScreen', [
                'model' => $model,
                'previous' => $previous,
            ]);
        }
        else{
            return $this->redirect(['login']);
        }
    }

    /**
     * Logs out the user.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
