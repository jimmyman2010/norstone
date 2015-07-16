<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\Url;
use common\models\Config;
use common\models\Category;
use yii\helpers\Json;
use common\models\Content;
use common\models\ContentSearch;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9 ]><html class="ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta property="fb:admins" content="<?= Config::findOne(['key' => 'FACEBOOK_ADMINS'])->value ?>" />
    <meta property="fb:app_id" content="<?= Config::findOne(['key' => 'FACEBOOK_APP_ID'])->value ?>" />
    <?= Html::csrfMetaTags() ?>
    <base href="<?= Url::base(true) ?>">
    <title><?= $this->title ?></title>
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/favicon/favicon.png" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800italic' rel='stylesheet' type='text/css'>
    <link rel="publisher" href="https://plus.google.com/<?= Config::findOne(['key' => 'GOOGLE_PUBLISHER'])->value ?>" />
    <link rel="canonical" href="<?= Url::canonical() ?>" />
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <link href="<?= Yii::$app->view->theme->baseUrl ?>/assets/css/ie8.css" rel="stylesheet" type="text/css"  media="all"  />
    <![endif]-->
    <!--[if gte IE 9]>
    <style type="text/css">.gradient {filter: none;}.header_cart {padding: 0 10px;}.header_cart .header_menu_figure {display: none;}</style>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?= Config::findOne(['key' => 'FACEBOOK_APP_ID'])->value ?>',
            xfbml      : true,
            version    : 'v2.3'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<?php $this->beginBody() ?>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<div id="wrapper">

    <div class="top-fix">
        <div class="container">
            <!-- LOGO -->
            <div id="logo">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/logo.png" alt="DUY TÂN COMPUTER" height="92"/>
                    <span class="shop_name trs_hover">DUY TÂN COMPUTER</span>
                </a>
            </div>

            <div class="header_menu gradient3">
                <!-- HEADER CART -->
                <a class="header_cart" href="javascript:;">
                    <div class="header_menu_figure gradient3"></div>
                    <i class="fa fa-map-marker"></i><span><?= Config::findOne(['key' => 'ADDRESS'])->value ?></span>
                </a>
            </div>
        </div>
    </div>
    <!-- HEADER -->
    <header id="header" class="container" style="position: relative">

        <!-- LOGO -->
        <div id="logo">
            <a href="<?= Yii::$app->homeUrl ?>">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/logo.png" alt="DUY TÂN COMPUTER" height="92"/>
                <span class="shop_name trs_hover">DUY TÂN COMPUTER</span>
            </a>
        </div>

        <div class="header_menu gradient3">
            <!-- HEADER CART -->
            <a class="header_cart" href="javascript:;">
                <div class="header_menu_figure gradient3"></div>
                <i class="fa fa-map-marker"></i><span><?= Config::findOne(['key' => 'ADDRESS'])->value ?></span>
            </a>

        </div>

        <!-- CUSTOM HEADER BLOCK -->
        <div class="custom_header1">
            <i class="fa fa-phone"></i>
            <h4><?= Config::findOne(['key' => 'PHONE'])->value ?></h4>
        </div>

        <div class="clearfix"></div>

        <!-- NAVIGATION -->
        <div id="navigation" class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <div class="navigation_content gradient1">
                    <nav role="navigation">
                        <ul class="sf-menu visible-lg">
                            <li class="first">
                                <?= Html::a('GIỚI THIỆU', ['page/view', 'slug' => 'gioi-thieu']) ?>
                            </li>
                            <li>
                                <?= Html::a('BẢNG GIÁ', ['page/view', 'slug' => 'bang-gia']) ?>
                            </li>
                            <li>
                                <?= Html::a('TIN TỨC', ['news/index']) ?>
                            </li>
                            <li>
                                <?= Html::a('HƯỚNG DẪN MUA HÀNG', ['page/view', 'slug' => 'huong-dan-mua-hang']) ?>
                            </li>
                            <li class="last">
                                <?= Html::a('LIÊN HỆ', ['site/contact']) ?>
                            </li>
                        </ul>
                    </nav>
                    <!-- HEADER SEARCH -->
                    <div class="header_search">
                        <form action="<?= Url::toRoute(['site/search']) ?>" method="get" class="search-form" role="search">
                            <input id="search-field" name="term" type="text" placeholder="Tìm kiếm" class="hint form-control" />
                            <button id="search-submit" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $widthBanner = Config::findOne(['key' => 'BANNER_WIDTH'])->value; ?>
        <div id="bannerscrollleft" style="left: -<?= $widthBanner+15 ?>px; width: <?= $widthBanner ?>px;" data-width="<?= $widthBanner ?>">
            <div id="floating_banner_left_content">
                <?php
                $widget = Content::find()->where([
                    'content_type' => Content::TYPE_BANNER,
                    'status' => Content::STATUS_PUBLISHED,
                    'deleted' => 0,
                    'sorting' => 0
                ])->orderBy('sorting')->all();
                ?>
                <?php foreach ($widget as $index => $item) { ?>
                    <a href="">
                        <img src="<?= $item->summary ?>" alt="" />
                    </a>
                <?php } ?>
            </div>
        </div>
        <div id="bannerscrollright" style="right: -<?= $widthBanner+15 ?>px; width: <?= $widthBanner ?>px;" data-width="<?= $widthBanner ?>">
            <div id="floating_banner_right_content"  >
                <?php
                $widget = Content::find()->where([
                    'content_type' => Content::TYPE_BANNER,
                    'status' => Content::STATUS_PUBLISHED,
                    'deleted' => 0,
                    'sorting' => 1
                ])->orderBy('sorting')->all();
                ?>
                <?php foreach ($widget as $index => $item) { ?>
                    <a href="<?= $item->content ?>">
                        <img src="<?= $item->summary ?>" alt="" />
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php
        $this->registerJs(
            "var slideTime = 700;
            function pepsi_floating_init(){
                xMoveTo('bannerscrollright', screen.width - 735, 0);
                winOnResize();
                xAddEventListener(window, 'resize', winOnResize, false);
                xAddEventListener(window, 'scroll', winOnScroll, false);
            }
            function winOnResize() {
                checkScreenWidth();
                winOnScroll();
            }
            function winOnScroll() {
                var y = xScrollTop() + 60;
                xSlideTo('bannerscrollleft', -15 - ".$widthBanner.", y, slideTime);
                xSlideTo('bannerscrollright', screen.width - 735, y, slideTime);
            }
            function checkScreenWidth(){
                if( document.body.clientWidth < 1400 ){
                    document.getElementById('bannerscrollleft').style.display = 'none';
                    document.getElementById('bannerscrollright').style.display = 'none';
                }else{
                    document.getElementById('bannerscrollleft').style.display = '';
                    document.getElementById('bannerscrollright').style.display = '';
                }
            }
            checkScreenWidth();
            pepsi_floating_init();"
        ); ?>

    </header>
    <!-- MAIN CONTENT -->
    <div id="main" role="main">
        <div class="container">
            <div class="row sidebar_none  sidebar_left">
                <div class="column_center">
                    <?= $content ?>
                </div>
                <div class="column_left column col-sm-3">
                    <div class="widget widget__collections">
                        <h3 class="widget_header gradient3">DANH MỤC</h3>
                        <div class="widget_content">
                            <ul>
                                <?php foreach(Category::getTree() as $index => $category) { ?>
                                    <?php if($category['show_in_menu']) { ?>
                                        <?php if(count($category['children']) > 0) { ?>
                                            <li class="has-sub-menu">
                                                <?= Html::a($category['name'] . '<i class="fa fa-chevron-circle-down"></i>',
                                                    ['product/category', 'id' => $category['id'], 'slug' => $category['slug']]) ?>
                                                <ul class="sub-menu">
                                                    <?php foreach ($category['children'] as $child) { ?>
                                                        <?php if($child['show_in_menu']) { ?>
                                                            <li>
                                                                <?= Html::a('<i class="fa fa-angle-double-right"></i>' . $child['name'],
                                                                    ['product/category', 'id' => $child['id'], 'slug' => $child['slug']]) ?>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li class="has-sub-menu">
                                                <?= Html::a($category['name'],
                                                    ['product/category', 'id' => $category['id'], 'slug' => $category['slug']]) ?>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>    <div class="widget widget__types">
                        <h3 class="widget_header gradient2">HỖ TRỢ</h3>
                        <div class="widget_content">
                            <ul class="list support">
                                <?php foreach(Json::decode(Config::findOne(['key' => 'SUPPORT'])->value) as $contact) { ?>
                                    <?php if($contact['type'] === 'yahoo') { ?>
                                    <li>
                                        <img src="<?= Url::toRoute(['site/yahoo-status', 'nickname' => trim($contact['nickname'])]) ?>"/>
                                        <a href="ymsgr:sendim?<?= trim($contact['nickname']) ?>"><?= trim($contact['name']) ?></a>
                                        <br/><a href="tel:<?= trim($contact['phone']) ?>"><?= trim($contact['phone']) ?></a>
                                    </li>
                                    <?php } else { ?>
                                    <li>
                                        <img src="<?= Url::toRoute(['site/skype-status', 'nickname' => trim($contact['nickname'])]) ?>"/>
                                        <a href="skype:<?= trim($contact['nickname']) ?>?chat"><?= trim($contact['name']) ?></a>
                                        <br/><a href="tel:<?= trim($contact['phone']) ?>"><?= trim($contact['phone']) ?></a>
                                    </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="widget widget_custom">
                        <div class="widget_content">
                            <div class="custom_sidebar custom_sidebar3">
                                <div class="fb-page" data-href="<?= Config::findOne(['key' => 'FACEBOOK_FANPAGE'])->value ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                                    <div class="fb-xfbml-parse-ignore">
                                        <blockquote cite="<?= Config::findOne(['key' => 'FACEBOOK_FANPAGE'])->value ?>">
                                            <a href="<?= Config::findOne(['key' => 'FACEBOOK_FANPAGE'])->value ?>">Máy tính để bàn đồng bộ</a>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $widget = Content::find()->where([
                                'content_type' => Content::TYPE_WIDGET,
                                'deleted' => 0,
                                'status' => Content::STATUS_PUBLISHED
                            ])->orderBy('sorting')->all();
                            ?>
                            <?php foreach ($widget as $index => $item) { ?>
                                <div class="custom_sidebar widget-sidebar custom_sidebar<?= $index ?>">
                                    <a class="trs_hover" href="javascript:;">
                                        <img src="<?= $item->summary ?>" alt="" />
                                        <?= $item->content ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BOTTOM -->
    <div id="bottom">
        <div class="container">
            <div class="row">
                <div class="custom_footer3 col-md-6 col-xs-12">
                    <h3>Follow us</h3>
                    <ul class="clearfix">
                        <li><a href="https://twitter.com/"><i class="fa fa-twitter-square"></i><span>Twitter</span></a></li>
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook-square"></i><span>Facebook</span></a></li>
                        <li><a href="https://google.com/"><i class="fa fa-google-plus-square"></i><span>Google+</span></a></li>

                    </ul>
                </div>

                <div class="custom_footer4 col-md-6 col-xs-12">
                    <h3>Địa chỉ</h3>
                    <ul class="clearfix">
                        <li><i class="fa fa-map-marker"></i><?= Config::findOne(['key' => 'ADDRESS'])->value ?></li>
                        <li><i class="fa fa-envelope"></i><a href="mailto:<?= Config::findOne(['key' => 'EMAIL'])->value ?>"><?= Config::findOne(['key' => 'EMAIL'])->value ?></a></li>
                        <li><i class="fa fa-phone"></i>
                            <a href="tel:<?= Config::findOne(['key' => 'PHONE_2'])->value ?>"><?= Config::findOne(['key' => 'PHONE_2'])->value ?></a>
                            /
                            <a href="tel:<?= Config::findOne(['key' => 'PHONE'])->value ?>"><?= Config::findOne(['key' => 'PHONE'])->value ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of #wrapper -->

<!-- FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="copyright" role="contentinfo">
            &copy; 2015 DUY TÂN Computer. Design by <a href="//mantrantd.com" target="_blank">Man Tran</a>.
        </div>
    </div>
</footer>
<?php $this->registerJs(" $('.customselect_wrap select').customSelect(); "); ?>

<?php $this->endBody() ?>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?= Config::findOne(['key' => 'GOOGLE_ANALYTIC'])->value ?>']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>
<?php $this->endPage() ?>