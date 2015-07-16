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
use yii\helpers\Json;
use common\models\Config;
use common\helpers\CurrencyHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $pictures array */
/* @var $tags array */
/* @var $relatedList array */
/* @var $related common\models\Product */

ProductAsset::register($this);

$this->title = !empty($model->seo_title) ? $model->seo_title : $model->name . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => !empty($model->seo_keyword) ? $model->seo_keyword : Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => !empty($model->seo_description) ? $model->seo_description : Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <?php if(!empty($category)) { ?>
            <li><a href="<?= Url::toRoute(['product/category', 'id' => $category->id, 'slug' => $category->slug]) ?>" title="<?= $category->name ?>"><?= $category->name ?></a></li>
        <?php } ?>
        <li class="lastItem"><span class="page-title"><?= $model->name ?></span></li>
    </ul>

    <div itemscope="" itemtype="http://schema.org/Product" class="product-scope">

        <meta itemprop="url" content="<?= Url::toRoute(['product/view', 'id' => $model->id, 'slug' => $model->slug]) ?>">
        <meta itemprop="image" content="<?= UtilHelper::getPicture($model->image_id, '', true) ?>">

        <div class="product_wrap">
            <div class="row">
                <div id="product_image-container" class="col-sm-5">
                    <?php if($model->is_discount) { ?>
                        <span class="discount"></span>
                    <?php } ?>
                    <?php if($model->is_hot) { ?>
                        <span class="hot"></span>
                    <?php } ?>
                    <div class="product_image">
                        <ul class="bxslider">
                            <?php foreach ($pictures as $index => $photo) { ?>
                                <li>
                                    <a rel="product_images" class="fancybox" href="<?= UtilHelper::getPicture($photo, '', true) ?>">
                                        <?= UtilHelper::getPicture($photo, 'slide') ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div id="bx-pager" class="product_image-additioanl">
                        <?php foreach ($pictures as $index => $photo) { ?>
                            <a href="javascript:;" data-slide-index="<?= $index ?>" <?php if($index===0) echo 'class="active"';?>>
                                <?= UtilHelper::getPicture($photo, 'thumbnail-slide') ?>
                            </a>
                        <?php } ?>
                    </div>
                </div><!-- #product-photos -->

                <div class="col-sm-7">
                    <h1 itemprop="name" class="product_name"><?= $model->name ?></h1>
                    <div class="options clearfix">
                        <ul>
                            <?php
                            if(empty($model->price_string)) { ?>
                                <li>
                                    <strong>Bảo hành 3 tháng: </strong>
                                    <input class="btn btn-cart price-current" type="button" name="add" id="add-to-cart"
                                           value="<?= intval($model->price) === 0 ? 'Liên hệ' : CurrencyHelper::formatNumber($model->price) ?>">
                                </li>
                            <?php
                            } else {
                                $priceArray = Json::decode($model->price_string);
                            ?>
                                <li>
                                    <strong>Bảo hành 3 tháng</strong>
                                    <input class="btn btn-cart price-current" type="button" name="add" id="add-to-cart" value="<?= intval($priceArray['month3']['current']) === 0 ? 'Liên hệ' : $priceArray['month3']['current'] ?>">
                                    <?php if(intval($priceArray['month3']['old']) !== 0) { ?>
                                        <input class="btn price-old" type="button" name="add" id="add-to-cart" value="<?= $priceArray['month3']['old'] ?>">
                                    <?php } ?>
                                </li>
                                <?php if(!(intval($priceArray['month3']['current']) === 0 && intval($priceArray['month12']['current']) === 0)) { ?>
                                <li>
                                    <strong>Bảo hành 12 tháng</strong>
                                    <input class="btn btn-cart price-current" type="button" name="add" id="add-to-cart" value="<?= intval($priceArray['month12']['current']) === 0 ? 'Liên hệ' : $priceArray['month12']['current'] ?>">
                                    <?php if(intval($priceArray['month12']['old']) !== 0) { ?>
                                        <input class="btn price-old" type="button" name="add" id="add-to-cart" value="<?= $priceArray['month12']['old'] ?>">
                                    <?php } ?>
                                </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div><!-- /.options -->
                    <?php if(count($tags) > 0) { ?>
                        <div class="product_details">
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

                    <div id="product_description" class="rte" itemprop="description">
                        <div class="product_desc">
                            <?= $model->description ?>
                        </div>
                    </div>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50568dd4418a8df1"></script>
                    <!-- AddThis Button END -->
                </div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="pagination pagination__product">
                            <ul>
<!--                                <li class="right-arrow lastItem firstItem"><span class="right"><a href="product-detail.php#content" title="">Sản phẩm khác →</a></span></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="information" role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active firstItem"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Tổng quan</a></li>
            <li role="presentation" class=""><a href="#infoTech" aria-controls="infoTech" role="tab" data-toggle="tab">Cấu hình chi tiết</a></li>
            <li role="presentation" class=""><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Ý kiến khách hàng</a></li>
            <li role="presentation" class="lastItem"><a href="#related" aria-controls="related" role="tab" data-toggle="tab">Sản phẩm liên quan</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">
                <div class="rte">
                    <?= $model->general ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="infoTech">
                <div class="rte">
                    <?= $model->info_tech ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="comments">
                <div class="widget_content">
                    <div class="fb-comments" data-version="v2.3"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="related">
                <div class="widget widget__related-products">
                    <div class="widget_content">
                        <div class="row">
                            <ul class="product-listing product-listing__related">
                                <?php foreach ($relatedList as $index => $related) { ?>
                                    <?= $this->render('_item', [
                                        'index' => $index,
                                        'product' => $related,
                                    ]) ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("

$('.bxslider').bxSlider({
    pagerCustom: '#bx-pager'
});

$('a.fancybox').fancybox({
    'transitionIn'  : 'elastic',
    'transitionOut' : 'elastic',
    'speedIn'   : 600,
    'speedOut'    : 200,
    'overlayShow' : true
});

");