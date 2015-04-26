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
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="<?= Yii::$app->view->theme->baseUrl ?>/bower_components/modernizr/modernizr.js"></script>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="site-wrapper">
        <header class="header">
            <div class="row">
                <div class="large-12 columns">
                    <div class="sticky contain-to-grid">
                        <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
                            <ul class="title-area">
                                <li class="name">
                                    <a href="<?= Yii::$app->homeUrl ?>">
                                        <img class="logo-fix" src="<?= Yii::$app->view->theme->baseUrl ?>/images/norstone_logo_white.png" alt="" />
                                        <img class="logo-normal" src="<?= Yii::$app->view->theme->baseUrl ?>/images/norstone_logo.png" alt="" />
                                    </a>
                                </li>
                                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                            </ul>

                            <section class="top-bar-section">
                                <?php
                                echo Menu::widget([
                                    'options' => [
                                        'class' => 'side-nav right'
                                    ],
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Home'),
                                            'url' => ['site/index'],
                                            'template' => '<a href="{url}"><i class="flaticon-house129"></i> {label}</a>'
                                        ],
                                        [
                                            'label' => Yii::t('app', 'News'),
                                            'url' => ['article/index'],
                                            'template' => '<a href="{url}"><i class="flaticon-star105"></i> {label}</a>'
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Contact us'),
                                            'url' => ['site/contact'],
                                            'template' => '<a href="{url}"><i class="flaticon-speech102"></i> {label}</a>'
                                        ]
                                    ]
                                ]);
                                ?>

                                <ul class="right">
                                    <li class="has-form">
                                        <form method="get" action="#">
                                            <div class="search-box" id="search-box">
                                                <input type="text" placeholder="Search" />
                                                <button type="submit"><span class="ti-search"></span></button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </section>
                        </nav>
                    </div>
                </div>
            </div>
        </header><!--end header-->

        <div class="row content">
            <div class="large-12 columns">

                <?= $content ?>

                <section class="socials text-center">
                    <h2>Share with you friends</h2>
                    <p>Do you like this page? Feel free to share it with your friends and architecture enthusiasts.</p>
                    <ul class="inline-list">
                        <li><a href="#" title="Facebook"><span class="ti-facebook"></span></a></li>
                        <li><a href="#" title="Twitter"><span class="ti-twitter"></span></a></li>
                        <li><a href="mailto:#" title="Email"><span class="ti-email"></span></a></li>
                    </ul>
                </section><!--end socials-->

            </div>
        </div><!--end content-->

        <footer class="footer text-center">
            <div class="row">
                <div class="large-12 columns">
                    <div class="links">
                        <a href="<?= Url::toRoute('site/official') ?>">Official Norstone Website</a>
                        <span>&nbsp;&bull;&nbsp;</span>
                        <a href="<?= Url::toRoute('site/legal') ?>">Legal</a>
                        <span>&nbsp;&bull;&nbsp;</span>
                        <a href="<?= Url::toRoute('site/trademarks') ?>">Trademarks</a>
                        <span>&nbsp;&bull;&nbsp;</span>
                        <a href="<?= Url::toRoute('site/contact') ?>">Contact Us</a>
                    </div>
                    <p class="copyright">Copyright &copy; <?= date('Y') ?> Norstone<p>
                </div>
            </div>
        </footer><!--end footer-->
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
