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
/* @var $model common\models\Product */
/* @var $pictures array */
/* @var $tags array */
/* @var $relatedList array */
/* @var $related common\models\Product */

$this->title = ucfirst($model->name) . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->params['breadcrumbs'][] = $model->name;

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
                    <div itemprop="name" class="product_name"><?= $model->name ?></div>
                    <div class="options clearfix">
                        <div id="purchase">
                            <input class="btn btn-cart" type="submit" name="add" id="add-to-cart" value="<?= UtilHelper::formatNumber($model->price) ?> VNĐ">
                        </div>
                    </div><!-- /.options -->

                    <div class="product_details">
                        <div class="product_type">Loại sản phẩm: <a href="/collections/types?q=USB%20Mice" title="USB Mice">Thùng máy</a></div>
                    </div>

                    <div id="product_description" class="rte" itemprop="description">
                        <h4>Mô tả:</h4>
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
                                <li class="right-arrow lastItem firstItem"><span class="right"><a href="product-detail.php#content" title="">Sản phẩm khác →</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(count($tags) > 0) { ?>
            <div class="blog-article_meta-tags">
                <span>Tags: </span>
                <?php
                }
                foreach ($tags as $index => $tag) {
                    if($index > 0)
                        echo ', ';
                    echo Html::a($tag->name, ['news/tag', 'slug' => $tag->slug]);
                }
                ?>
                <?php if(count($tags) > 0) { ?>
            </div>
            <?php } ?>
        </div>

    </div>


    <div class="information" role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active firstItem"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tổng quan</a></li>
            <li role="presentation" class="lastItem"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Thông số kỷ thuật</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="rte">
                    <?= $model->general ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="rte">
                    <?= $model->info_tech ?>
                </div>
            </div>
        </div>
    </div>

    <div class="widget widget__related-products">

        <div class="widget_header">
            <h3>Phản hồi</h3>
        </div>
        <div class="widget_content">
            <div id="disqus_thread"><iframe id="dsq-2" data-disqus-uid="2" allowtransparency="true" frameborder="0" scrolling="no" tabindex="0" title="Disqus" width="100%" src="http://disqus.com/embed/comments/?base=default&amp;version=2fd469d8025ef2cff25569832e5cbb1d&amp;f=mantrantddev&amp;t_u=http%3A%2F%2Fcomputer.theme%2Fproduct-detail.php&amp;t_d=DUY%20T%C3%82N%20COMPUTER&amp;t_t=DUY%20T%C3%82N%20COMPUTER&amp;s_o=default#2" style="width: 100% !important; border: none !important; overflow: hidden !important; height: 321px !important;" horizontalscrolling="no" verticalscrolling="no"></iframe></div>
            <noscript>Please enable JavaScript to view the &lt;a href="https://disqus.com/?ref_noscript" rel="nofollow"&gt;comments powered by Disqus.&lt;/a&gt;</noscript>
        </div>

    </div>

    <div class="widget widget__related-products">

        <div class="widget_header">
            <h3>Sản phẩm cùng loại</h3>
        </div>
        <div class="widget_content">
            <div class="row">
                <ul class="product-listing product-listing__related">
                    <?php foreach ($relatedList as $index => $related) { ?>
                        <li class="product col-sm-4 columns-3 <?php if($index%3 === 0) echo 'item_alpha'; elseif($index%3 === 2) echo 'item_omega'; ?>">
                            <div class="product_img">
                                <a href="<?= Url::toRoute(['product/view', 'id' => $related->id, 'slug' => $related->slug]) ?>" title="<?= $model->name ?>">
                                    <?= UtilHelper::getPicture($related->image_id, 'thumbnail') ?>
                                </a>
                            </div>
                            <div class="product_name">
                                <?= Html::a($related->name, ['product/view', 'id' => $related->id, 'slug' => $related->slug]) ?>
                            </div>
                            <div class="product_price"><span class="money"><?= $related->price ?> VNĐ</span></div>
                        </li>
                    <?php } ?>
                </ul>
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

/* * * CONFIGURATION VARIABLES * * */
var disqus_shortname = '" . Config::findOne(['key' => 'DISQUS'])->value . "';

/* * * DON'T EDIT BELOW THIS LINE * * */
(function() {
    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
})();

");