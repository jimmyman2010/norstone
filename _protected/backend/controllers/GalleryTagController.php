<?php

namespace backend\controllers;

use Yii;
use common\models\GalleryTag;
use common\models\GalleryTagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryTagController implements the CRUD actions for GalleryTag model.
 */
class GalleryTagController extends Controller
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
     * Lists all GalleryTag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GalleryTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GalleryTag model.
     * @param integer $gallery_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionView($gallery_id, $tag_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($gallery_id, $tag_id),
        ]);
    }

    /**
     * Creates a new GalleryTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryTag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GalleryTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $gallery_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionUpdate($gallery_id, $tag_id)
    {
        $model = $this->findModel($gallery_id, $tag_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gallery_id' => $model->gallery_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GalleryTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $gallery_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionDelete($gallery_id, $tag_id)
    {
        //$this->findModel($gallery_id, $tag_id)->delete();
        $model = $this->findModel($gallery_id, $tag_id);
        $model->deleted = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GalleryTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $gallery_id
     * @param integer $tag_id
     * @return GalleryTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gallery_id, $tag_id)
    {
        if (($model = GalleryTag::findOne(['gallery_id' => $gallery_id, 'tag_id' => $tag_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
