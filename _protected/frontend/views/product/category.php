<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 6/29/2015
 * Time: 11:07 AM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;
use frontend\assets\ProductAsset;
use yii\widgets\Breadcrumbs;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $product common\models\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ucfirst($model->name) . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->params['breadcrumbs'][] = $model->name;

ProductAsset::register($this);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <?php if($model->parent_id > 0) { ?>
            <li><a href="<?= Url::toRoute(['product/category', 'id' => $model->parent_id, 'slug' => $model->parent->slug]) ?>" title="<?= $model->parent->name ?>"><?= $model->parent->name ?></a></li>
        <?php } ?>
        <li class="lastItem"><span class="page-title"><?= $model->name ?></span></li>
    </ul>

    <div class="index-scope">

        <h2 class="page_heading">SẢN PHẨM HP</h2>

        <?php if($model->description) { ?>
            <div class="rte"><?= $model->description ?></div>
        <?php } ?>

        <div class="product-listing product-listing__index">
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $index => $product) { ?>
                    <div class="product product__product-grid-item columns-3 col-sm-4 <?php if($index%3 === 0) echo 'item_alpha'; elseif($index%3 === 2) echo 'item_omega'; ?>">
                        <div class="product_img">
                            <a href="<?= Url::toRoute(['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?>">
                                <?= UtilHelper::getPicture($product->image_id, 'thumbnail') ?>
                            </a>
                        </div>
                        <div class="product_name">
                            <?= Html::a($product->name, ['product/view', 'id' => $product->id, 'slug' => $product->slug]) ?>
                        </div>
                        <div class="product_links">
                            <button class="btn btn-cart" type="button"><?= UtilHelper::formatNumber($product->price) ?> VNĐ</button>
                            <?= Html::a('Chi tiết', ['product/view', 'id' => $product->id, 'slug' => $product->slug], ['class'=>'btn']) ?>
                        </div>
                    </div>
                <?php } ?>
            </div>


<!--            <ul id="pagination" class="pagination">-->
<!--                <li><span class="previous"><a href="?page=2" title="">&laquo; Quay lại</a></span></li>-->
<!--                <li><span class="page current">1</span></li>-->
<!--                <li><span class="page"><a href="?page=2" title="">2</a></span></li>-->
<!--                <li><span class="page"><a href="?page=3" title="">3</a></span></li>-->
<!--                <li><span class="next"><a href="?page=2" title="">Trang kế tiếp &raquo;</a></span></li>-->
<!--            </ul>-->

        </div>
    </div>
</div>