<?php
namespace frontend\controllers;

use common\models\FileSearch;
use common\models\Gallery;
use common\models\GalleryFile;
use common\models\GallerySearch;
use common\models\TagSearch;
use frontend\models\Article;
use frontend\models\ArticleSearch;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class GalleryController extends FrontendController
{
    /**
     * Lists all Article models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * How many articles we want to display per page.
         * @var integer
         */
        $pageSize = 9;

        /**
         * Articles have to be published.
         * @var boolean
         */
        $published = true;

        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $published);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * 
     * @param  string $slug
     * @return mixed
     */
    public function actionView($slug)
    {
        $model = $this->findModelBySlug($slug);
        $id = $model->id;

        $searchRelated = new GallerySearch();
        $relatedList = $searchRelated->search(['gallery_id' => $id]);

        $searchPicture = new FileSearch();
        $pictures = $searchPicture->search(['gallery_id' => $id]);

        $searchTag = new TagSearch();
        $tags = $searchTag->search(['gallery_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'relatedList' => $relatedList->getModels(),
            'pictures' => $pictures->getModels(),
            'tags' => $tags->getModels(),
            'previous' => $this->previousGallery($id),
            'next' => $this->nextGallery($id)
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer  $id
     * @return Article The loaded model.
     * 
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne([
                'id' => $id,
                'deleted' => 0,
                'status' => Gallery::STATUS_PUBLISHED
            ])) !== null)
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param string $slug
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Gallery::findOne([
                'slug' => $slug,
                'deleted' => 0,
                'status' => Gallery::STATUS_PUBLISHED
            ])) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param int $id
     * @return null|static
     */
    protected function nextGallery($id)
    {
        $max = Gallery::find()->max('id');
        do {
            $id++;
            $previousModel = Gallery::findOne([
                'id' => $id,
                'deleted' => 0,
                'status' => Gallery::STATUS_PUBLISHED
            ]);
            if($previousModel !== null) {
                return $previousModel;
            }
        } while ($id < $max);
        return null;
    }

    /**
     * @param int $id
     * @return null|static
     */
    protected function previousGallery($id)
    {
        do {
            $id--;
            $previousModel = Gallery::findOne([
                'id' => $id,
                'deleted' => 0,
                'status' => Gallery::STATUS_PUBLISHED
            ]);
            if($previousModel !== null) {
                return $previousModel;
            }
        } while ($id > 0);
        return null;
    }
}
