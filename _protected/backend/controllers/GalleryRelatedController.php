<?php

namespace backend\controllers;

use Yii;
use common\models\GalleryRelated;
use common\models\GalleryRelatedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryRelatedController implements the CRUD actions for GalleryRelated model.
 */
class GalleryRelatedController extends Controller
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
     * Lists all GalleryRelated models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GalleryRelatedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryRelated model.
     * @param integer $gallery_id
     * @param integer $related_id
     * @return mixed
     */
    public function actionView($gallery_id, $related_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($gallery_id, $related_id),
        ]);
    }

    /**
     * Creates a new GalleryRelated model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryRelated();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'related_id' => $model->related_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GalleryRelated model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $gallery_id
     * @param integer $related_id
     * @return mixed
     */
    public function actionUpdate($gallery_id, $related_id)
    {
        $model = $this->findModel($gallery_id, $related_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'related_id' => $model->related_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GalleryRelated model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $gallery_id
     * @param integer $related_id
     * @return mixed
     */
    public function actionDelete($gallery_id, $related_id)
    {
        $this->findModel($gallery_id, $related_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GalleryRelated model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $gallery_id
     * @param integer $related_id
     * @return GalleryRelated the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gallery_id, $related_id)
    {
        if (($model = GalleryRelated::findOne(['gallery_id' => $gallery_id, 'related_id' => $related_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
