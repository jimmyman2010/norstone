<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all">
    <script src="<?= Yii::$app->view->theme->baseUrl ?>/js/vendor/modernizr.js"></script>
    <?php $this->head() ?>
</head>
<body>
    <div class="site-wrapper">
        <?php $this->beginBody() ?>
        <div class="wrapper row">
            <div class="large-12 columns content-bg">
                <nav class="top-navigation" role="navigation">
                    <div class="row">
                        <div class="large-2 medium-4 small-12 columns top-part-no-padding">
                            <div class="logo-bg">
                                <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/logo/jmgroup-white.png" alt="JM GROUP" />
                                <a href="javascript:;" class="toggles" data-toggle="hide">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="large-10 medium-8 small-12 columns top-menu">
                            <div class="row">
                                <div class="large-6 medium-6 small-12 columns">
                                    <div class="row">
                                        <div class="large-8 columns top-search">
                                            <input type="text" placeholder="Search" />
                                        </div>
                                    </div>
                                </div>
                                <div class="large-4 medium-6 small-12 columns">
                                    <div class="row">
                                        <div class="medium-9 small-9 columns howdy">
                                            <?= Yii::t('app', 'Howdy') ?>, <?= Yii::$app->user->identity->username ?>
                                        </div>
                                        <div class="medium-3 small-3 columns logout">
                                            <?= Html::a('<i class="fa fa-power-off"></i>', ['/site/logout'], ['data-method'=>'post']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </nav>
                <div class="row">
                    <aside class="large-2 medium-12 small-12 columns">
                        <nav class="main-nav row">
                            <?php
                            echo Menu::widget([
                                'options' => [
                                    'class' => 'side-nav'
                                ],
                                'items' => [
                                    [
                                        'label' => Yii::t('app', 'General'),
                                        'url' => ['javascript:;'],
                                        'template' => '{label}',
                                        'options' => ['class' => 'group-item']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Dashboard'),
                                        'url' => ['site/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-home"></i>{label}</a>'
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Products'),
                                        'url' => ['product/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-archive"></i>{label}</a>'
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Category'),
                                        'url' => ['category/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-magic"></i>{label}</a>'
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Tags'),
                                        'url' => ['tag/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-tags"></i>{label}</a>'
                                    ],
                                    [
                                        'label' => Yii::t('app', 'System'),
                                        'url' => ['javascript:;'],
                                        'template' => '{label}',
                                        'options' => ['class' => 'group-item']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Users'),
                                        'url' => ['user/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-user"></i>{label}</a>',
                                        /*'items' => [
                                            [
                                                'label' => 'Add user',
                                                'url' => ['user/create'],
                                                'template' => '<a href="{url}"><i class="fa fa-user-plus"></i>{label}</a>',
                                            ]
                                        ]*/
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Pages'),
                                        'url' => ['page/index'],
                                        'template' => '<a href="{url}"><i class="fa fa-clipboard"></i>{label}</a>'
                                    ],
                                ],
                            ]);
                            ?>
                        </nav>
                    </aside>
                    <main class="large-10 medium-12 small-12 columns container" role="main">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'breadcrumbs']
                        ]) ?>
                        <?= $content ?>
                    </main>
                </div>
            </div>
        </div>

        <?php $this->endBody() ?>
    </div>
    <div class="copyright">
        <?= date('Y') ?> &copy; <?= Yii::t('app', Yii::$app->name) ?>. Powered by <?= Html::a('Man Tran', 'http://www.mantrantd.com', ['target' => '_blank']) ?>
    </div>
    <?php
    $this->registerJs("
        var goLockScreen = false;
        var stop = false;
        var autoLockTimer;
        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer; // catches touchscreen presses
        window.onclick = resetTimer;     // catches touchpad clicks
        window.onscroll = resetTimer;    // catches scrolling with arrow keys
        window.onkeypress = resetTimer;

        function lockScreen() {
            stop = true;
            window.location.href = '" . Url::toRoute(['/site/lock-screen']) . "?previous='+encodeURIComponent(window.location.href);
        }

        function lockIdentity(){
            goLockScreen = true;
        }

        function resetTimer() {
            if(stop==true){

            }
            else if (goLockScreen) {
                lockScreen();
            }
            else{
                clearTimeout(autoLockTimer);
                autoLockTimer = setTimeout(lockIdentity, " . (Yii::$app->session->timeout * 1000) . ");  // time is in milliseconds
            }

        }

        $(document).foundation();
    ");

    ?>
</body>
</html>
<?php $this->endPage() ?>
