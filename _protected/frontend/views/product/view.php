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
use frontend\assets\SliderAsset;
use yii\helpers\Json;
use common\models\Config;
use common\helpers\CurrencyHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $pictures array */
/* @var $tags array */
/* @var $relatedList array */
/* @var $related common\models\Product */

SliderAsset::register($this);

$this->title = !empty($model->seo_title) ? $model->seo_title : $model->name . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => !empty($model->seo_keyword) ? $model->seo_keyword : Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => !empty($model->seo_description) ? $model->seo_description : Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div class="row" role="article">
    <div class="col-md-12 main-container">
        <ul class="breadcrumb">
            <li><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="Quay lại trang chủ"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
            <?php if(!empty($category)) { ?>
                <li><a href="<?= Url::toRoute(['product/category', 'id' => $category->id, 'slug' => $category->slug]) ?>" title="<?= $category->name ?>"><?= $category->name ?></a></li>
            <?php } ?>
            <li><span class="page-title"><?= $model->name ?></span></li>
        </ul>
        <div class="module-content product-detail">
            <h1 itemprop="name"><?= $model->name ?></h1>
            <div class="row">
                <div class="col-sm-5">
                    <?php if($model->is_discount) { ?>
                        <span class="discount"></span>
                    <?php } ?>
                    <?php if($model->is_hot) { ?>
                        <span class="hot"></span>
                    <?php } ?>
                    <div class="product-image">
                        <ul class="slider-for">
                            <?php foreach ($pictures as $index => $photo) { ?>
                                <li class="item"<?= $index > 0 ? ' style="display:none" ' : '' ?>>
                                    <a rel="product_images" class="fancybox" href="<?= UtilHelper::getPicture($photo, '', true) ?>">
                                        <?= UtilHelper::getPicture($photo, 'slide') ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="slider-nav">
                        <?php foreach ($pictures as $index => $photo) { ?>
                            <a class="item" href="javascript:;" style="display:none">
                                <?= UtilHelper::getPicture($photo, 'thumbnail-slide') ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm-7">
                    <ul class="price">
                        <?php
                        if(empty($model->price_string)) { ?>
                            <li>
                                <strong>Bảo hành 3 tháng: </strong>
                                <span class="new"><?= intval($model->price) === 0 ? 'Liên hệ' : CurrencyHelper::formatNumber($model->price) ?></span>
                            </li>
                            <?php
                        } else {
                            $priceArray = Json::decode($model->price_string);
                            ?>
                            <li>
                                <strong>Bảo hành 3 tháng: </strong>
                                <span class="new"><?= intval($priceArray['month3']['current']) === 0 ? 'Liên hệ' : $priceArray['month3']['current'] ?></span>
                                <?php if(intval($priceArray['month3']['old']) !== 0) { ?>
                                    <span class="old"><?= $priceArray['month3']['old'] ?></span>
                                <?php } ?>
                            </li>
                            <?php if(!(intval($priceArray['month3']['current']) === 0 && intval($priceArray['month12']['current']) === 0)) { ?>
                                <li>
                                    <strong>Bảo hành 12 tháng: </strong>
                                    <span class="new"><?= intval($priceArray['month12']['current']) === 0 ? 'Liên hệ' : $priceArray['month12']['current'] ?></span>
                                    <?php if(intval($priceArray['month12']['old']) !== 0) { ?>
                                        <span class="old"><?= $priceArray['month12']['old'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                    <?php if(count($tags) > 0) { ?>
                    <div class="product-details">
                        <span>Tags: </span>
                        <?php
                        }
                        foreach ($tags as $index => $tag) {
                            if($index > 0)
                                echo ', ';
                            echo Html::a($tag->name, ['product/tag', 'slug' => $tag->slug]);
                        }
                        ?>
                        <?php if(count($tags) > 0) { ?>
                    </div>
                <?php } ?>

                    <div class="product-description rte" itemprop="description">
                        <?= $model->description ?>
                    </div>
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_native_toolbox"></div>
                </div>
            </div>

            <div class="information">
                <!-- Tab panes -->
                <aside>
                    <div class="widget">
                        <header><h2>Tổng quan</h2></header>
                        <div class="content-widget rte">
                            <?= $model->general ?>
                        </div>
                    </div>
                <?php if($model->info_tech) { ?>
                    <div class="widget">
                        <header><h2>Thông số kỷ thuật</h2></header>
                        <div class="content-widget rte">
                            <?= $model->info_tech ?>
                        </div>
                    </div>
                <?php } ?>
                    <div class="widget">
                        <header><h2>Ý kiến khách hàng</h2></header>
                        <div class="content-widget">
                            <div class="fb-comments" data-width="100%"></div>
                        </div>
                    </div>
                    <div class="widget">
                        <header><h2>Sản phẩm liên quan</h2></header>
                        <div class="content-widget list">
                            <?php foreach ($relatedList as $index => $related) { ?>
                                <?= $this->render('_item', [
                                    'index' => $index,
                                    'product' => $related,
                                ]) ?>
                            <?php } ?>
                        </div>
                    </div>
                </aside>
            </div>


        </div>
    </div>
</div>

<?php
$this->registerJs("
    $('.slider-for .item').show();
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav .item').show();
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        focusOnSelect: true
    });
    $('.fancybox').fancybox({
        nextEffect : 'none',
    	prevEffect	: 'none'
    });

");

$this->registerJsFile('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50568dd4418a8df1', ['async' => 'async']);
