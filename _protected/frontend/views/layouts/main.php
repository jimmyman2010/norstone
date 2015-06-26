<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title>DUY TÂN COMPUTER</title>

    <link rel="canonical" href="" />
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/favicon/favicon.png" />

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800italic' rel='stylesheet' type='text/css'>

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
                    <i class="fa fa-map-marker"></i><span>10/26 Hoàng Hoa Thám, P7, Q.Bình Thạnh, TP.Hồ Chí Minh</span>
                </a>
            </div>
        </div>
    </div>
    <!-- HEADER -->
    <header id="header" class="container">

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
                <i class="fa fa-map-marker"></i><span>10/26 Hoàng Hoa Thám, P7, Q.Bình Thạnh<span class="city">, TP.Hồ Chí Minh</span></span>
            </a>

        </div>

        <!-- CUSTOM HEADER BLOCK -->
        <div class="custom_header1">
            <i class="fa fa-phone"></i>
            <h4>0983 176 671</h4>
        </div>

        <div class="clearfix"></div>

        <!-- NAVIGATION -->
        <div id="navigation" class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <div class="navigation_content gradient1">
                    <nav role="navigation">
                        <ul class="sf-menu visible-lg">
                            <li class=" first color-1">
                                <a href="page.php" title="">GIỚI THIỆU</a>
                            </li>
                            <li class=" color-2">
                                <a href="page.php" title="">BẢNG GIÁ</a>
                            </li>
                            <li class=" color-2">
                                <a href="blog.php" title="">BLOG</a>
                            </li>
                            <li class=" color-3">
                                <a href="page.php" title="">HƯỚNG DẪN MUA HÀNG</a>
                            </li>
                            <li class=" last color-4">
                                <a href="contact.php" title="">LIÊN HỆ</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- HEADER SEARCH -->
                    <div class="header_search">
                        <form action="search.php" method="get" class="search-form" role="search">
                            <input id="search-field" name="q" type="text" placeholder="Tìm kiếm" class="hint form-control" />
                            <button id="search-submit" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </header>
    <!-- MAIN CONTENT -->
    <div id="main" role="main">
        <div class="container">

            <div class="row sidebar_none  sidebar_left">

                <div class="column_center">
                    <?= $content ?>

                </div>

                <div class="column_left column col-sm-3">

                    <!--    --><!--    -->
                    <div class="widget widget__collections">
                        <h3 class="widget_header gradient3">DANH MỤC</h3>
                        <div class="widget_content">
                            <ul>

                                <li class="has-sub-menu accessories">
                                    <a href="product_list.php" title="Máy bộ HP">Máy bộ HP<i class="fa fa-chevron-circle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="product_list.php" title="Máy bộ HP DC 7900"><i class="fa fa-angle-double-right"></i>Máy bộ HP DC 7900</a></li>

                                        <li><a href="product_list.php" title="Máy bộ HP DC 7800"><i class="fa fa-angle-double-right"></i>Máy bộ HP DC 7800</a></li>

                                        <li><a href="product_list.php" title="Máy bộ HP DC 7700"><i class="fa fa-angle-double-right"></i>Máy bộ HP DC 7700</a></li>

                                        <li><a href="product_list.php" title="Máy bộ HP 6000 Pro"><i class="fa fa-angle-double-right"></i>Máy bộ HP 6000 Pro</a></li>
                                    </ul>
                                </li>

                                <li class="has-sub-menu cases">
                                    <a href="product_list.php" title="Máy bộ Dell">Máy bộ Dell<i class="fa fa-chevron-circle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 740"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 740</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 755"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 755</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 760"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 760</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 780"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 780</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 790"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 790</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 796"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 796</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Vostro/Inpiron"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Vostro/Inpiron</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell XPS/Studio"><i class="fa fa-angle-double-right"></i>Máy bộ Dell XPS/Studio</a></li>

                                        <li><a href="product_list.php" title="Máy bộ Dell Optiplex 380"><i class="fa fa-angle-double-right"></i>Máy bộ Dell Optiplex 380</a></li>
                                    </ul>
                                </li>

                                <li class="cd-dvd-drives">
                                    <a href="product_list.php" title="Máy bộ Fujitsu, Acer, Nec...">Máy bộ Fujitsu, Acer, Nec...</a>
                                </li>

                                <li class="clearance">
                                    <a href="product_list.php" title="Máy tính cũ giá rẻ">Máy tính cũ giá rẻ</a>
                                </li>

                                <li class="controller-cards">
                                    <a href="product_list.php" title="Máy bộ game và đồ họa">Máy bộ game và đồ họa</a>
                                </li>

                                <li class="cpus-processors">
                                    <a href="product_list.php" title="Màn hình LCD cũ">Màn hình LCD cũ</a>
                                </li>

                                <li class="drive-enclosures">
                                    <a href="product_list.php" title="Laptop cũ">Laptop cũ</a>
                                </li>
                            </ul>
                        </div>
                    </div>    <div class="widget widget__types">
                        <h3 class="widget_header gradient2">HỖ TRỢ</h3>
                        <div class="widget_content">
                            <ul class="list">
                                <li>
                                    <img src="http://vitinhgiatot.com/lib/is_online.php?id=duytan_computer350"/>
                                    <a href="ymsgr:sendim?duytan_computer350">Kinh doanh 1</a>
                                </li>
                                <li>
                                    <img src="http://vitinhgiatot.com/lib/is_online.php?id=vitinh_giatot"/>
                                    <a href="ymsgr:sendim?vitinh_giatot">Kinh doanh 2</a>
                                </li>
                                <li>
                                    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
                                    <div id="SkypeButton_Call_tranduyminhman_1">
                                        <script type="text/javascript">
                                            Skype.ui({
                                                "name": "chat",
                                                "element": "SkypeButton_Call_tranduyminhman_1",
                                                "participants": ["tranduyminhman"],
                                                "imageSize": 32
                                            });
                                        </script>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget widget__best-sellers">
                        <h3 class="widget_header gradient1">TAG CLOUD</h3>
                        <div class="widget_content">
                            <div class="product-listing product-listing__bestsellers">

                                <div class="tags" style="padding: 5px">
                                    <p>
                                        <span style="font-size: medium;">M</span><span style="font-size: medium;">áy bộ dell | &nbsp;
                            <span style="font-size: x-large;">
                                <span style="color: rgb(0, 128, 128);">máy bộ hp</span>
                            </span><span style="color: rgb(0, 128, 128);">
                                <span style="font-size: large;"> </span></span>
                            <span style="font-size: large;">|&nbsp;</span>
                            &nbsp;Máy tính để bàn | Dell Optiplex 780 |&nbsp;</span>
                        <span style="font-size: x-large;">
                            <span style="color: rgb(128, 128, 128);">máy bộ dell Optiplex 780</span>
                        </span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="widget widget_custom">
                        <div class="widget_content">
                            <div class="custom_sidebar custom_sidebar3">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-page" data-href="https://www.facebook.com/maytinhdebandongbo" data-width="100%" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                                    <div class="fb-xfbml-parse-ignore">
                                        <blockquote cite="https://www.facebook.com/maytinhdebandongbo">
                                            <a href="https://www.facebook.com/maytinhdebandongbo">Máy tính để bàn đồng bộ</a>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="custom_sidebar custom_sidebar1">
                                <a class="trs_hover" href="#">
                                    <i class="fa fa-dropbox"></i>
                                    <h3>MIỄN PHÍ VẬN CHUYỂN</h3>
                                    <h4>cho hóa đơn trên 5.000.000 VNĐ</h4>
                                </a>
                            </div>
                            <div class="custom_sidebar custom_sidebar2">
                                <a class="trs_hover" href="#">
                                    <i class="fa fa-phone"></i>
                                    <h3>Liên lạc đường dây nóng:</h3>
                                    <h4>0983 176 671</h4>
                                </a>
                            </div>
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
                        <li><i class="fa fa-map-marker"></i>10/26 Hoàng Hoa Thám, P7, Q.Bình Thạnh, TP.Hồ Chí Minh</li>
                        <li><i class="fa fa-envelope"></i><a href="mailto:duytancomputer350@gmail.com">duytancomputer350@gmail.com</a></li>
                        <li><i class="fa fa-phone"></i><a href="tel:08 62788887">08 62788887</a> / <a href="tel:0938 176 671">0938 176 671</a></li>
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
</body>
</html>
<?php $this->endPage() ?>