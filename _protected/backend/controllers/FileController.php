<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use Imagine\Image\Box;
use Yii;
use common\models\File;
use common\models\FileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

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
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $mediaType
     * @return mixed
     */
    public function actionUpload($mediaType)
    {
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        $object = UtilHelper::upload($_FILES['file'], $mediaType, $chunk, $chunks);

        if($object) {
            $model = new File();
            $model->name = $object->fileName;
            $model->media = $mediaType;
            $model->show_url = $object->fileUrl;
            $model->directory = $object->fileDir;
            $model->file_name = $object->fileName;
            $model->file_type = $_FILES['file']['type'];
            $model->file_size = $_FILES['file']['size'];
            $model->file_ext = $object->fileExt;
            if ($mediaType === $model::MEDIA_IMAGE) {
                $object = UtilHelper::generateImage($object->filePath, $object->filePath);
                if($object)
                {
                    $model->dimension = $object->getWidth() . 'x' . $object->getHeight();
                    $model->width = $object->getWidth();
                    $model->height = $object->getHeight();
                } else {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "Failed to resize image."}, "id" : 0}');
                }
            }

            $model->save(false);

            // Return Success JSON-RPC response
            die('{"jsonrpc" : "2.0", "result" : "'.$model->show_url.'?time='.time().'", "id" : '.$model->id.'}');
        }
        // Return error JSON-RPC response
        die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "Failed to write in file."}, "id" : 0}');

    }



    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
