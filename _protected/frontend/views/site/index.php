<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Yii::t('app', Yii::$app->name);

?>

<div id="main_content" class="col-sm-9">
    <!-- SLIDER -->
    <div class="slider_wrap">
        <div class="nivoSlider">
            <a href="/collections/all">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide1_image.jpg" title="#htmlcaption-1" />
            </a>
            <a href="/collections/fans-cooling">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide2_image.jpg" title="#htmlcaption-2" />
            </a>
            <a href="/collections/cd-dvd-drives">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide3_image.jpg" title="#htmlcaption-3" />
            </a>
        </div>
    </div>

    <div class="caption_hidden">
        <div id="htmlcaption-1">
            <div class="nivo-caption-1">
                <a href="/collections/all">
                    <h2>gọi ngay</h2>
                    <h3>ĐƯỜNG DÂY NÓNG:</h3>
                    <h4>0983 176 671</h4>
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                </a>
            </div>
        </div>
        <div id="htmlcaption-2">
            <div class="nivo-caption-2">
                <a href="/collections/fans-cooling">
                    <h2>miễn phí</h2>
                    <h3>VẬN CHUYỂN</h3>
                    <h4></h4>
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                </a>
            </div>
        </div>
        <div id="htmlcaption-3">
            <div class="nivo-caption-3">
                <a href="/collections/cd-dvd-drives">
                    <h2>giảm giá lên tới</h2>
                    <h3>-50</h3>
                    <h4>%</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                </a>
            </div>
        </div>
        <div id="htmlcaption-4">
            <div class="nivo-caption-4">
                <h2></h2>
                <h3></h3>
                <h4></h4>
                <p></p>
            </div>
        </div>

        <div id="htmlcaption-5">
            <div class="nivo-caption-5">
                <h2></h2>
                <h3></h3>
                <h4></h4>
                <p></p>
            </div>
        </div>
    </div>

<?php
$this->registerJs("
    $('.nivoSlider').nivoSlider({
        effect:'fade',
        animSpeed:500,
        pauseTime:7000,
        startSlide:0,
        pauseOnHover:true,
        directionNav:false,
        directionNavHide:false,
        controlNav:true
    });
");

?>
    <div class="index-scope">

        <h2 class="page_heading">SẢN PHẨM NỔI BẬT</h2>

        <div class="product-listing product-listing__index">
            <div class="row">
            <?php foreach ($featured as $index => $product) { ?>
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
        </div>

    </div>

</div>