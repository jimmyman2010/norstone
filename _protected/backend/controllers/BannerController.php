<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/14/2015
 * Time: 9:06 AM
 */

namespace backend\controllers;

use common\helpers\SlugHelper;
use common\models\ContentFile;
use common\models\ContentTag;
use common\models\File;
use common\models\FileSearch;
use common\models\Tag;
use common\models\TagSearch;
use Yii;
use common\models\Content;
use common\models\ContentSearch;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class WidgetController implements the CRUD actions for Content model.
 * @package backend\controllers
 */
class BannerController extends BackendController {

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentSearch();
        $params = Yii::$app->request->queryParams;
        $params['ContentSearch']['content_type'] = Content::TYPE_BANNER;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Content();

        $model->name = 'New a widget';
        $model->slug = $model->getSlug('new-a-widget');
        $model->summary = 'summary widget';
        $model->status = Content::STATUS_DRAFT;
        $model->content_type = Content::TYPE_BANNER;
        $model->created_date = time();
        $model->created_by = Yii::$app->user->identity->username;

        if($model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }
        else {
            return $this->redirect(['index']);
        }
    }

    /**
     * @param int $slideId
     * @param array $pictureData
     * @return void
     */
    protected function updatePicture($slideId, $pictureData)
    {
        $fileList = [];
        if(is_array($pictureData)) {
            foreach ($pictureData as $index => $value) {
                if (($modelFile = File::findOne(intval($value['id']))) !== null) {
                    if (!empty($value['caption'])) {
                        $modelFile->caption = $value['caption'];
                    }
                    $modelFile->deleted = 0;
                    $modelFile->save(false);
                    array_push($fileList, $modelFile->id);

                    if (($modelContentFile = ContentFile::findOne(['content_id' => $slideId, 'file_id' => intval($value['id'])])) !== null) {
                        $modelContentFile->deleted = 0;
                    } else {
                        $modelContentFile = new ContentFile();
                        $modelContentFile->content_id = $slideId;
                        $modelContentFile->file_id = $modelFile->id;
                    }
                    $modelContentFile->save(false);
                }
            }
        }

        $contentFileObjects = ContentFile::findAll(['content_id'=>$slideId]);
        foreach ($contentFileObjects as $object) {
            if(!in_array($object->file_id, $fileList)){
                $object->delete();
            }
        }
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(isset(Yii::$app->request->post()['Content']['slug'])) {
                $model->slug = $model->getSlug(SlugHelper::makeSlugs($model->slug), $id);
            }
            else {
                if(empty($model->slug) || $model->updated_date === 0) {
                    $model->slug = $model->getSlug(SlugHelper::makeSlugs($model->name), $id);
                }
            }
            if(intval(Yii::$app->request->post()['type-submit']) === 1) {
                if($model->status !== Content::STATUS_PUBLISHED) {
                    $model->status = Content::STATUS_PUBLISHED;
                    $model->published_date = time();
                }
            }
            $model->sorting = intval($model->sorting);

            $model->updated_date = time();
            if($model->save()) {
                $this->updatePicture($model->id, isset(Yii::$app->request->post()['Picture']) ? Yii::$app->request->post()['Picture'] : []);
                return $this->redirect(['index']);
            }
        } else {
            $dataProvider = new FileSearch();
            $pictures = $dataProvider->search(['content_id' => $id])->getModels();

            if($model->updated_date === 0) {
                $model->name = '';
                $model->slug = '';
                $model->summary = '';
            }
            return $this->render('update', [
                'model' => $model,
                'pictures' => $pictures,
            ]);
        }
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->deleted = 1;

        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param string $name
     * @param int $id
     * @return bool
     */
    public function actionCheckingduplicated($name, $id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($id === 0) {
            $exist = Content::findOne(['name' => $name]);
        }
        else {
            $exist = Content::findOne(['name' => $name]);
            if(is_object($exist) && $exist->id === intval($id)) {
                $exist = null;
            }
        }
        return $exist === null;
    }

}