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

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $pictures array */
/* @var $tags array */
/* @var $relatedList array */

$this->title = ucfirst($model->name) . ' | ' . Yii::t('app', Yii::$app->name);
$this->params['breadcrumbs'][] = $model->name;

ProductAsset::register($this);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="index.php" class="homepage-link" title="Back to the frontpage">Home</a></li>
        <li class="lastItem"><span class="page-title">Contacts</span></li>
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

                    <div class="social-details">
                        <span class='st_facebook_hcount' displayText='Facebook'></span>
                        <span class='st_twitter_hcount' displayText='Tweet'></span>
                        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
                        <span class='st_email_hcount' displayText='Email'></span>
                        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
                        <script type="text/javascript">var switchTo5x=true;</script>
                        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                        <script type="text/javascript">stLight.options({publisher: "f5aa822b-dd9d-40c5-ab1d-949e4ccb9e9c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
                    </div>
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
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES * * */
                var disqus_shortname = 'mantrantddev';

                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
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
                    <li class="product col-sm-4 columns-3 item_alpha firstItem">
                        <div class="product_img">
                            <a href="product-detail.php" title="ViewSonic VX1962wm 19-Inch LCD Monitor">
                                <img src="uploads/viewsonic_vx1962wm_19-inch_lcd_monitor_1_medium.jpeg?v=1388409093" alt="">
                            </a>
                        </div>
                        <div class="product_name">
                            <a href="product-detail.php" title="ViewSonic VX1962wm 19-Inch LCD Monitor">ViewSonic VX1962wm 19-Inch LCD Monitor</a>
                        </div>
                        <div class="product_price"><span class="money">$160.00</span></div>
                    </li>
                    <li class="product col-sm-4 columns-3 ">
                        <div class="product_img">
                            <a href="product-detail.php" title="Apple iPad 2 (16GB Wi-Fi">
                                <img src="uploads/apple_ipad_2_16gb_wi-fi_black_1_medium.jpeg?v=1388409097" alt="">
                            </a>
                        </div>
                        <div class="product_name">
                            <a href="product-detail.php" title="Apple iPad 2 (16GB Wi-Fi">Apple iPad 2 (16GB Wi-Fi</a>
                        </div>
                        <div class="product_price"><span class="money">$780.00</span></div>
                    </li>
                    <li class="product col-sm-4 columns-3 item_omega lastItem">
                        <div class="product_img">
                            <a href="product-detail.php" title="NAS Qnap TS-219P">
                                <img src="uploads/nas_qnap_ts-219p_1_medium.jpeg?v=1388409103" alt="">
                            </a>
                        </div>
                        <div class="product_name">
                            <a href="product-detail.php" title="NAS Qnap TS-219P">NAS Qnap TS-219P</a>
                        </div>
                        <div class="product_price"><span class="money">$1,100.00</span></div>
                    </li>
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

");