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
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */
/* @var $product common\models\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

ProductAsset::register($this);

$this->title = $model->name . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <li class="lastItem"><span class="page-title"><?= ucfirst($model->name) ?></span></li>
    </ul>

    <div class="index-scope">

        <h2 class="page_heading"><?= $model->name ?></h2>
        <?php Pjax::begin(['id' => 'products']) ?>
        <div class="product-listing product-listing__index">
            <div class="category-sorting clearfix">
                <div class="total-count">Tổng cộng có <?= $dataProvider->totalCount ?> sản phẩm</div>
                <div class="dropdownbox">
                    <span>Sắp xếp</span>
                    <?php $orderBy = Yii::$app->getRequest()->getQueryParam('orderby'); ?>
                    <select>
                        <option value="<?= Url::toRoute(['product/category', 'id' => $model->id, 'slug' => $model->slug]) ?>">Mặc định</option>
                        <option <?= $orderBy === 'gt' ? 'selected="selected"' : '' ?> value="<?= Url::toRoute(['product/category', 'id' => $model->id, 'slug' => $model->slug, 'orderby' => 'gt']) ?>">Giá tăng</option>
                        <option <?= $orderBy === 'gg' ? 'selected="selected"' : '' ?> value="<?= Url::toRoute(['product/category', 'id' => $model->id, 'slug' => $model->slug, 'orderby' => 'gg']) ?>">Giá giảm</option>
                        <option <?= $orderBy === 'az' ? 'selected="selected"' : '' ?> value="<?= Url::toRoute(['product/category', 'id' => $model->id, 'slug' => $model->slug, 'orderby' => 'az']) ?>">Tên A - Z</option>
                        <option <?= $orderBy === 'za' ? 'selected="selected"' : '' ?> value="<?= Url::toRoute(['product/category', 'id' => $model->id, 'slug' => $model->slug, 'orderby' => 'za']) ?>">Tên Z - A</option>
                    </select>
                </div>
            </div>
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
                            <button class="btn btn-cart" type="button"><?= intval($product->price) === 0 ? 'Liên hệ' : UtilHelper::formatNumber($product->price) . ' VNĐ' ?></button>
                            <?= Html::a('Chi tiết', ['product/view', 'id' => $product->id, 'slug' => $product->slug], ['class'=>'btn']) ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <nav class="pagination">
                <?= LinkPager::widget([
                    'pagination'=>$dataProvider->pagination,
                    'nextPageLabel' => 'Trang kế tiếp &raquo;',
                    'prevPageLabel' => '&laquo; Quay lại',
                ]) ?>
            </nav>
        </div>
        <?php Pjax::end() ?>
    </div>
</div>