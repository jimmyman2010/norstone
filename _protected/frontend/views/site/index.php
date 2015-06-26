<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Yii::t('app', Yii::$app->name);

?>

<div id="main_content" class="col-sm-9">
    <!-- SLIDER -->
    <div class="slider_wrap">
        <div class="nivoSlider">


            <a href="/collections/all">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide1_image.jpg?14633606393534071235" title="#htmlcaption-1" />
            </a>



            <a href="/collections/fans-cooling">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide2_image.jpg?14633606393534071235" title="#htmlcaption-2" />
            </a>



            <a href="/collections/cd-dvd-drives">
                <img src="<?= Yii::$app->view->theme->baseUrl ?>/assets/images/slider/slide3_image.jpg?14633606393534071235" title="#htmlcaption-3" />
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

                <div class="product product__product-grid-item columns-3 col-sm-4 item_alpha">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/apple_g5_powermac_2ghz_desktop_computer_1_medium.jpeg?v=1388409089" alt="Apple G5 PowerMac 2GHz Desktop Computer" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Apple G5 PowerMac 2GHz Desktop Computer</a>
                    </div>

                    <div class="product_links">
                        <button class="btn btn-cart" type="submit">3.750.000 VNĐ</button>
                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 ">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/viewsonic_vx1962wm_19-inch_lcd_monitor_1_medium.jpeg?v=1388409093" alt="ViewSonic VX1962wm 19-Inch LCD Monitor" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">ViewSonic VX1962wm 19-Inch LCD Monitor</a>
                    </div>

                    <div class="product_links">
                        <button class="btn btn-cart" type="submit">$160.00</button>
                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 item_omega">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/apple_ipad_2_16gb_wi-fi_black_1_medium.jpeg?v=1388409097" alt="Apple iPad 2 (16GB Wi-Fi" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Apple iPad 2 (16GB Wi-Fi</a>
                    </div>

                    <div class="product_links">
                        <button class="btn btn-cart" type="submit">$780.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 item_alpha">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/nas_qnap_ts-219p_1_medium.jpeg?v=1388409103" alt="NAS Qnap TS-219P" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">NAS Qnap TS-219P</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$1,100.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 ">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/be_quiet__readies_1kw_dark_power_pro_psu_1_medium.jpeg?v=1388409109" alt="Be Quiet! Readies 1kW Dark Power Pro PSU" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Be Quiet! Readies 1kW Dark Power Pro PSU</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$600.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 item_omega">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/altec_lansing_fx3022_expressionist_bass_2-way_speaker_for_pc_and_mp3_1_medium.jpeg?v=1388409113" alt="Altec Lansing FX3022 Expressionist BASS 2-Way Speaker for PC and MP3" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Altec Lansing FX3022 Expressionist BASS 2-Way Speaker for PC and MP3</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$450.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 item_alpha">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/dell_inspiron_1520_1_medium.jpeg?v=1388409117" alt="Dell Inspiron 1520" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Dell Inspiron 1520</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$320.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 ">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/creative_live__cam_optia_af_webcam_1_medium.jpeg?v=1388409122" alt="Creative Live! Cam Optia AF webcam" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">Creative Live! Cam Optia AF webcam</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$265.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

                <div class="product product__product-grid-item columns-3 col-sm-4 item_omega">

                    <div class="product_img">
                        <a href="product-detail.php">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/uploads/3dconnexion_3d_space_explorer_fmo-3sn_1_medium.jpeg?v=1388409127" alt="3DConnexion 3d Space Explorer FMo-3SN" />
                        </a>
                    </div>

                    <div class="product_name">
                        <a href="product-detail.php">3DConnexion 3d Space Explorer FMo-3SN</a>
                    </div>

                    <div class="product_links">

                        <button class="btn btn-cart" type="submit">$199.00</button>

                        <a class="btn" href="product-detail.php">Chi tiết</a>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>