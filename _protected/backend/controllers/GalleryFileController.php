<?php

namespace backend\controllers;

use Yii;
use common\models\GalleryFile;
use common\models\GalleryFileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryFileController implements the CRUD actions for GalleryFile model.
 */
class GalleryFileController extends Controller
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
     * Lists all GalleryFile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GalleryFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryFile model.
     * @param integer $gallery_id
     * @param integer $file_id
     * @return mixed
     */
    public function actionView($gallery_id, $file_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($gallery_id, $file_id),
        ]);
    }

    /**
     * Creates a new GalleryFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryFile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'file_id' => $model->file_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GalleryFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $gallery_id
     * @param integer $file_id
     * @return mixed
     */
    public function actionUpdate($gallery_id, $file_id)
    {
        $model = $this->findModel($gallery_id, $file_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'file_id' => $model->file_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GalleryFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $gallery_id
     * @param integer $file_id
     * @return mixed
     */
    public function actionDelete($gallery_id, $file_id)
    {
        $this->findModel($gallery_id, $file_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GalleryFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $gallery_id
     * @param integer $file_id
     * @return GalleryFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gallery_id, $file_id)
    {
        if (($model = GalleryFile::findOne(['gallery_id' => $gallery_id, 'file_id' => $file_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
