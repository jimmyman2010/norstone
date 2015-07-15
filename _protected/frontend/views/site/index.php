<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;
use common\models\Config;
use common\helpers\SlugHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <!-- SLIDER -->
    <div class="slider_wrap">
        <div class="nivoSlider">
            <?php foreach ($dataProvider->getModels() as $index => $slide) { ?>
                <img src="<?= UtilHelper::getPicture($slide->image_id, '', true) ?>" title="#htmlcaption-<?= $index + 1 ?>" alt="" />
            <?php } ?>
        </div>
    </div>

    <div class="caption_hidden">
        <?php foreach ($dataProvider->getModels() as $index => $slide) { ?>
            <div id="htmlcaption-<?= $index + 1 ?>">
                <?= $slide->content ?>
            </div>
        <?php } ?>
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
                <?= $this->render('../product/_item', [
                    'index' => $index,
                    'product' => $product,
                ]) ?>
            <?php } ?>
            </div>
        </div>

    </div>

</div>