<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 6/29/2015
 * Time: 10:48 AM
 */

namespace frontend\controllers;

use common\models\Category;
use common\models\FileSearch;
use common\models\Product;
use common\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProductController extends FrontendController {

    /**
     * Displays a single Product model.
     *
     * @param  integer $id
     * @param  string $slug
     * @return mixed
     */
    public function actionView($id, $slug)
    {
        $dataProvider = new FileSearch();
        $pictures = $dataProvider->search(['product_id' => $id])->getModels();

        $tags = Tag::find()
            ->innerJoin('tbl_product_tag', 'tbl_product_tag.tag_id = tbl_tag.id')
            ->where(['tbl_tag.deleted' => 0, 'tbl_product_tag.deleted' => 0, 'tbl_product_tag.product_id' => $id])
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'pictures' => $pictures,
            'tags' => $tags
        ]);
    }

    /**
     * Displays Products by category.
     *
     * @param  integer $id
     * @param  string $slug
     * @return mixed
     */
    public function actionCategory($id, $slug)
    {
        $query = Product::find()
            ->innerJoin('tbl_product_category', 'tbl_product_category.product_id = tbl_product.id')
            ->where([
                'tbl_product_category.deleted' => 0,
                'tbl_product.deleted' => 0,
                'tbl_product_category.category_id' => $id,
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('category', [
            'model' => $this->findCategoryModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer  $id
     * @return Product The loaded model.
     *
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCategoryModel($id)
    {
        if (($model = Category::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}