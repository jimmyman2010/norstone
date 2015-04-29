<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;
use frontend\assets\GalleryAsset;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $previous common\models\Gallery */
/* @var $next common\models\Gallery */
/* @var $pictures array */
/* @var $tags array */
/* @var $relatedList array */

$this->title = ucfirst($model->name) . ' | ' . Yii::t('app', Yii::$app->name);
$this->params['breadcrumbs'][] = $model->name;

GalleryAsset::register($this);
?>

<div class="row">
    <div class="left-content small-12 large-8 columns">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs'],
            'activeItemTemplate' => "<li class=\"current\">{link}</li>\n"
        ]) ?>
        <div class="gallery-slide">
            <ul data-orbit
                data-options="pause_on_hover:true;
                slide_number:false;
                resume_on_mouseout:true;
                  next_on_click:false;
                  animation_speed:700;
                  bullets:false;">
                <?php foreach ($pictures as $index => $picture) { ?>
                    <li data-orbit-slide="slide-<?=($index + 1)?>">
                        <a href="<?= UtilHelper::getPicture($picture, '', true) ?>" class="view-large ti-fullscreen fancybox" data-fancybox-group="gallery"></a>

                        <?= UtilHelper::getPicture($picture, 'slide') ?>
                        <?php if(!empty($picture->caption)) { ?>
                        <div class="orbit-caption"><?= $picture->caption ?></div>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
            <div class="thumbs">
                <ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5">
                    <?php
                    $count = 0;
                    foreach ($pictures as $index => $picture) {
                        $count++;
                        ?>
                    <li data-orbit-link="slide-<?=($index + 1)?>">
                        <?= UtilHelper::getPicture($picture, 'thumbnail-slide') ?>
                    </li>
                    <?php } while($count < 5) {
                        $count++;
                        ?>
                        <li class="holder"></li>
                    <?php } ?>
                </ul>
            </div><!--end thumbs-->
        </div><!--end gallery slide-->
    </div><!--end left content-->
    <div class="right-content small-12 large-4 columns">
        <div class="next-prev">
            <a class="prev left<?= $previous ? '' : ' disabled' ?>" href="<?= $previous ? Url::toRoute(['gallery/view', 'slug' => $previous->slug]) : 'javascript:;' ?>"><span class="ti-arrow-circle-left"></span> &nbsp;<?= Yii::t('app', 'Previous') ?></a>
            <a class="next right<?= $next ? '' : ' disabled' ?>" href="<?= $next ? Url::toRoute(['gallery/view', 'slug' => $next->slug]) : 'javascript:;' ?>"><?= Yii::t('app', 'Next') ?> &nbsp;<span class="ti-arrow-circle-right"></span></a>
        </div>
        <div class="close"><a href="<?= Url::home() ?>" class="right">Close <span class="ti-close"></span></a></div>
        <h2><?= Html::encode($model->name) ?></h2>
        <div class="des"><?= $model->description ?></div>

        <?php if(!empty($model->lean_more_link)) { ?>
        <p><a href="<?= Url::to($model->lean_more_link) ?>" target="_blank" class="more-btn button radius">Learn more</a></p>
        <?php } ?>

        <ul class="info">
            <li><strong>Product name:</strong> <?= $model->product->name ?> </li>
            <li><strong>Colour:</strong> <?= $model->color->name ?></li>
            <li><strong>Application:</strong> <?= $model->application ? Yii::t('app', 'Internal') : Yii::t('app', 'External') ?> </li>
            <li><strong>Tags:</strong>
                <?php foreach ($tags as $item) { ?>
                <span class="label success round"><?= $item->name ?></span>
                <?php } ?>
            </li>
        </ul>

    </div><!--end right content-->
</div>

<div class="shared-this">
    <p>Share with your friends:</p>
    <span class='st_facebook_hcount' displayText='Facebook'></span>
    <span class='st_twitter_hcount' displayText='Tweet'></span>
    <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
    <span class='st_sharethis_hcount' displayText='ShareThis'></span>
</div><!--end viral tools-->

<?php if(count($relatedList) > 0) { ?>
<aside class="gallery-list related-gallery">
    <h3 class="text-center"><span>See also this images</span></h3>
    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
        <?php foreach ($relatedList as $item) { ?>
        <li class="gallery-thumb">
            <?= $this->render('_item_details', ['model' => $item]) ?>
        </li>
        <?php } ?>
    </ul>
</aside><!--end related gallery-->
<?php } ?>