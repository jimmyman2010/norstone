<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Config;
use common\models\Category;
use yii\helpers\Json;
use common\models\Content;
use yii\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="fb:app_id" content="<?= Config::findOne(['key' => 'FACEBOOK_APP_ID'])->value ?>" />
    <?= Html::csrfMetaTags() ?>
    <base href="<?= Url::base(true) ?>">
    <title><?= $this->title ?></title>
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->view->theme->baseUrl ?>/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->view->theme->baseUrl ?>/images/favicon/favicon.png" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,800,600italic' rel='stylesheet' type='text/css'>
    <link rel="publisher" href="https://plus.google.com/<?= Config::findOne(['key' => 'GOOGLE_PUBLISHER'])->value ?>" />
    <link rel="canonical" href="<?= Url::canonical() ?>" />

    <script src="<?= Yii::$app->view->theme->baseUrl ?>/js/lib/modernizr.min.js"></script>
    <?php $this->head() ?>
</head>
<body>
<div id="fb-root"></div>
<?php $this->beginBody() ?>
<div class="site-wrapper">
    <div class="left-under">
        <div class="logo">
            <figure>
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/duytan.png" alt="DUY TÂN Computer" />
                </a>
                <figcaption>DUY TÂN COMPUTER</figcaption>
            </figure>
        </div>
        <a class="close-under" href="javascript:void(0);"></a>
        <?= \frontend\widgets\LeftUnder::widget() ?>
    </div>
    <div class="wrapper">
        <div class="top-nav">
            <a href="javascript:void(0);" data-target=".left-under" class="open-under"></a>
            <div class="container">
                <div class="top-left">
                    Hotline: <a class="tel" href="tel:<?= Config::findOne(['key' => 'PHONE'])->value ?>"><?= Config::findOne(['key' => 'PHONE'])->value ?></a> !
                    <p>
                        <?php if(Yii::$app->user->isGuest) { ?>
                            <?= Html::a('<i class="glyphicon glyphicon-user"></i> Đăng nhập', ['site/login']) ?>
                        <?php } else { ?>
                            <i class="glyphicon glyphicon-user"></i> Chào <?= Yii::$app->user->identity->username ?> !
                            <?= Html::a('<i class="glyphicon glyphicon-log-out"></i> Đăng xuất', ['site/logout'], ['data'=>['method'=>'POST']]) ?>
                        <?php } ?>
                    </p>
                </div>
                <div class="top-right">
                    <span><i class="glyphicon glyphicon-road"></i><?= Config::findOne(['key' => 'ADDRESS'])->value ?></span>
                </div>
            </div>
        </div>
        <div class="scrolling">
            <div class="container">
                <?php $widthBanner = Config::findOne(['key' => 'BANNER_WIDTH'])->value; ?>
                <div id="floatdiv" class="adv floating left" style="left: -<?= $widthBanner ?>px; width: <?= $widthBanner ?>px;" data-width="<?= $widthBanner ?>">
                    <div class="content">
                        <?php
                        $widget = Content::find()->where([
                            'content_type' => Content::TYPE_BANNER,
                            'status' => Content::STATUS_PUBLISHED,
                            'deleted' => 0,
                            'parent_id' => 0
                        ])->orderBy('sorting')->all();
                        ?>
                        <?php foreach ($widget as $index => $item) { ?>
                            <a href="">
                                <img src="<?= $item->summary ?>" alt="" />
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="adv floating right" style="right: -<?= $widthBanner ?>px; width: <?= $widthBanner ?>px;" data-width="<?= $widthBanner ?>">
                    <div class="content">
                        <?php
                        $widget = Content::find()->where([
                            'content_type' => Content::TYPE_BANNER,
                            'status' => Content::STATUS_PUBLISHED,
                            'deleted' => 0,
                            'parent_id' => 1
                        ])->orderBy('sorting')->all();
                        ?>
                        <?php foreach ($widget as $index => $item) { ?>
                            <a href="<?= $item->content ?>">
                                <img src="<?= $item->summary ?>" alt="" />
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <header class="header" role="banner">
            <div class="container">
                <div class="logo">
                    <figure>
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/duytan.png" alt="DUY TÂN Computer" />
                        </a>
                        <figcaption>DUY TÂN COMPUTER</figcaption>
                    </figure>
                </div>
                <nav class="main-menu" role="navigation">
                    <?= \frontend\widgets\MenuTop::widget() ?>
                </nav>
                <br clear="all" />
                <div class="header-bar">
                    <div class="main-search">
                        <form action="<?= Url::toRoute(['site/search']) ?>">
                            <i class="glyphicon glyphicon-search"></i>
                            <input name="term" type="search" />
                            <button>TÌM</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main class="main" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 left-rail" role="complementary">
                        <?= \frontend\widgets\MenuLeft::widget() ?>

                        <div class="module support">
                            <h3 class="title">Hỗ trợ</h3>
                            <ul class="content list">
                                <?php foreach(Json::decode(Config::findOne(['key' => 'SUPPORT'])->value) as $contact) { ?>
                                    <?php if($contact['type'] === 'yahoo') { ?>
                                        <li>
                                            <a class="icon" href="ymsgr:sendim?<?= trim($contact['nickname']) ?>">
                                                <img src="<?= Url::toRoute(['site/yahoo-status', 'nickname' => trim($contact['nickname'])]) ?>"/>
                                            </a>
                                            <p>
                                                <a class="name" href="ymsgr:sendim?<?= trim($contact['nickname']) ?>"><?= trim($contact['name']) ?></a>
                                                <br/><a href="tel:<?= trim($contact['phone']) ?>"><?= trim($contact['phone']) ?></a>
                                            </p>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a class="icon" href="skype:<?= trim($contact['nickname']) ?>?chat">
                                                <img src="<?= Url::toRoute(['site/skype-status', 'nickname' => trim($contact['nickname'])]) ?>"/>
                                            </a>
                                            <p>
                                                <a class="name" href="skype:<?= trim($contact['nickname']) ?>?chat"><?= trim($contact['name']) ?></a>
                                                <br/><a href="tel:<?= trim($contact['phone']) ?>"><?= trim($contact['phone']) ?></a>
                                            </p>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="module news">
                            <h3 class="title">Blog</h3>
                            <ul class="content list">
                                <?php
                                $news = Content::find()->where([
                                    'content_type' => Content::TYPE_NEWS,
                                    'status' => Content::STATUS_PUBLISHED,
                                    'deleted' => 0
                                ])->orderBy('created_date DESC')->limit(5)->all();
                                ?>
                                <?php foreach ($news as $index => $item) { ?>
                                    <li>
                                        <?= Html::a($item->name, ['news/view', 'id' => $item->id, 'slug' => $item->slug]) ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="module fan-page">
                            <div class="fb-page" data-href="https://www.facebook.com/maytinhdebandongbo" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                                <div class="fb-xfbml-parse-ignore">
                                    <blockquote cite="https://www.facebook.com/maytinhdebandongbo">
                                        <a href="https://www.facebook.com/maytinhdebandongbo">Máy tính để bàn đồng bộ</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="module adv">
                            <div class="content">
                                <?php
                                $widget = Content::find()->where([
                                    'content_type' => Content::TYPE_BANNER,
                                    'status' => Content::STATUS_PUBLISHED,
                                    'deleted' => 0,
                                    'parent_id' => 2
                                ])->orderBy('sorting')->all();
                                ?>
                                <?php foreach ($widget as $index => $item) { ?>
                                    <a href="<?= $item->content ?>">
                                        <img src="<?= $item->summary ?>" alt="" />
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="information">
                    <h3 class="title"><a class="back-to-top" href="javascript:void(0);">Về đầu trang <i class="glyphicon glyphicon-triangle-top"></i></a></h3>
                    <div class="content">
                        <div class="col-md-4">
                            <div class="contact-info">
                                <h4>Chăm sóc Khách Hàng:</h4>
                                <p class="tel"><a href="tel:08 62788887">(08) 62788887</a> <br/> <a href="tel:<?= Config::findOne(['key' => 'PHONE'])->value ?>"><?= Config::findOne(['key' => 'PHONE'])->value ?></a></p>
                                <p>E-mail: <a href="mailto:<?= Config::findOne(['key' => 'EMAIL'])->value ?>"><?= Config::findOne(['key' => 'EMAIL'])->value ?></a></p>
                                <p><?= Config::findOne(['key' => 'ADDRESS'])->value ?></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="menu-footer">

                                <?= \frontend\widgets\MenuBottom::widget() ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <p>&copy; 2015 Duy Tan Computer</p>
                    <p>Powered by <a href="http://www.mantrantd.com">Man Tran</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=<?= Config::findOne(['key' => 'FACEBOOK_APP_ID'])->value ?>";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
<?php $this->endPage() ?>