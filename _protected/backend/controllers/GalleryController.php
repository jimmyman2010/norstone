<?php

namespace backend\controllers;

use common\helpers\UtilHelper;
use common\models\File;
use common\models\FileSearch;
use common\models\GalleryFile;
use common\models\GalleryFileSearch;
use common\models\GalleryTag;
use common\models\GalleryTagSearch;
use common\models\Tag;
use common\models\TagSearch;
use Yii;
use common\models\Gallery;
use common\models\GallerySearch;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if($model->load(Yii::$app->request->post()))
        {
            $model->status = Yii::$app->request->post()['type-submit'] === Yii::t('app', 'Publish') ? Gallery::STATUS_PUBLISHED : Gallery::STATUS_DRAFT;
            $model->publish_date = time();
            $model->created_date = time();
            $model->created_by = Yii::$app->user->identity->username;

            if ($model->save()) {
                $this->updatePicture($model->id, isset(Yii::$app->request->post()['Picture']) ? Yii::$app->request->post()['Picture'] : []);
                $this->updateTags($model->id, isset(Yii::$app->request->post()['Tag']) ? Yii::$app->request->post()['Tag'] : '');
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $dataProvider = new TagSearch();
            $tagObjects = $dataProvider->search([])->getModels();
            $tagSuggestions = '';
            foreach ($tagObjects as $obj) {
                $tagSuggestions .= $obj->name . ',';
            }
            $tagSuggestions = rtrim($tagSuggestions, ',');

            $model->application = 1;
            return $this->render('create', [
                'model' => $model,
                'pictures' => [],
                'tags' => '',
                'tagSuggestions' => Html::encode($tagSuggestions)
            ]);
        }
    }

    /**
     * @param int $galleryId
     * @param array $pictureData
     * @return void
     */
    protected function updatePicture($galleryId, $pictureData)
    {
        $fileList = [];
        foreach ($pictureData as $index => $value) {
            if(($modelFile = File::findOne(intval($value['id']))) !== null) {
                if(!empty($value['caption'])) {
                    $modelFile->caption = $value['caption'];
                }
                $modelFile->deleted = 0;
                $modelFile->save(false);
                array_push($fileList, $modelFile->id);

                if(($modelGalleryFile = GalleryFile::findOne(['gallery_id' => $galleryId, 'file_id' => intval($value['id'])])) !== null) {
                    $modelGalleryFile->deleted = 0;
                } else {
                    $modelGalleryFile = new GalleryFile();
                    $modelGalleryFile->gallery_id = $galleryId;
                    $modelGalleryFile->file_id = $modelFile->id;
                }
                $modelGalleryFile->save(false);
            }
        }
        $galleryFileSearch = new GalleryFileSearch();
        $galleryFileObjects = $galleryFileSearch->search(['gallery_id'=>$galleryId])->getModels();
        foreach ($galleryFileObjects as $object) {
            if(!in_array($object->file_id, $fileList)){
                $object->delete();
            }
        }
    }

    /**
     * @param int $galleryId
     * @param string $tagString
     * @return void
     */
    protected function updateTags($galleryId, $tagString)
    {
        if(!empty($tagString))
        {
            $tagList = [];
            foreach (Json::decode($tagString) as $tagName) {
                $tagObject = Tag::findOne(['name' => $tagName]);
                if($tagObject !== null) {
                    $tagObject->deleted = 0;
                } else {
                    $tagObject = new Tag();
                    $tagObject->name = $tagName;
                    $tagObject->slug = UtilHelper::slugify($tagName);
                }
                $tagObject->save(false);
                array_push($tagList, $tagObject->id);

                $galleryTagObject = GalleryTag::findOne(['gallery_id'=>$galleryId, 'tag_id'=>$tagObject->id]);
                if($galleryTagObject !== null) {
                    $galleryTagObject->deleted = 0;
                } else {
                    $galleryTagObject = new GalleryTag();
                    $galleryTagObject->gallery_id = $galleryId;
                    $galleryTagObject->tag_id = $tagObject->id;
                }
                $galleryTagObject->save(false);
            }

            $galleryTagSearch = new GalleryTagSearch();
            $galleryTagObjects = $galleryTagSearch->search(['gallery_id'=>$galleryId])->getModels();
            foreach ($galleryTagObjects as $object) {
                if(!in_array($object->tag_id, $tagList)){
                    $object->deleted = 1;
                    $object->save(false);
                }
            }
        }
    }

    /**
     * @param int $galleryId
     * @param array $relatedData
     * @return void
     */
    protected function updateRelated($galleryId, $relatedData){

    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = Yii::$app->request->post()['type-submit'] === Yii::t('app', 'Publish') ? Gallery::STATUS_PUBLISHED : Gallery::STATUS_DRAFT;
            if($model->save()) {
                $this->updatePicture($model->id, isset(Yii::$app->request->post()['Picture']) ? Yii::$app->request->post()['Picture'] : []);
                $this->updateTags($model->id, isset(Yii::$app->request->post()['Tag']) ? Yii::$app->request->post()['Tag'] : '');
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $dataProvider = new FileSearch();
            $pictures= $dataProvider->search(['gallery_id' => $id])->getModels();

            $dataProvider = new TagSearch();
            $tags= $dataProvider->search(['gallery_id' => $id])->getModels();
            $tagList = [];
            foreach ($tags as $tag) {
                array_push($tagList, $tag->name);
            }

            $dataProvider = new TagSearch();
            $tagObjects = $dataProvider->search([])->getModels();
            $tagSuggestions = '';
            foreach ($tagObjects as $obj) {
                $tagSuggestions .= $obj->name . ',';
            }
            $tagSuggestions = rtrim($tagSuggestions, ',');

            return $this->render('update', [
                'model' => $model,
                'pictures' => $pictures,
                'tags' => Json::encode($tagList),
                'tagSuggestions' => $tagSuggestions
            ]);
        }
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->deleted = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
