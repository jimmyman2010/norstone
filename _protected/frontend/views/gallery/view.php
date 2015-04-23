<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="left-content small-12 large-8 columns">

        <div class="gallery-slide">
            <ul data-orbit data-options="animation:slide;
                                                             timer: false;
                                                             slide_number: false;
                                                             animation_speed:500;
                                                             navigation_arrows:true;
                                                             bullets:false;">
                <?php foreach ($pictures as $index => $picture) { ?>
                    <li data-orbit-slide="slide-<?=($index + 1)?>">
                        <a href="<?= UtilHelper::getPicture($picture, '', true) ?>" class="view-large ti-fullscreen" data-lightbox="gallery" title="<h4>1 Sint occaecati cupiditate non provident</h4><p>At vero eos et accusamus et iusto odio dignissimos <a href='#'>ducimus qui blanditiis</a> praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, <a href=''>id est laborum</a> et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>"></a>

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
            <a class="prev left<?= $previous ? '' : ' disabled' ?>" href="<?= $previous ? Url::toRoute(['gallery/view', 'id' => $previous]) : 'javascript:;' ?>"><span class="ti-arrow-circle-left"></span> &nbsp;<?= Yii::t('app', 'Previous') ?></a>
            <a class="next right<?= $next ? '' : ' disabled' ?>" href="<?= $next ? Url::toRoute(['gallery/view', 'id' => $next]) : 'javascript:;' ?>"><?= Yii::t('app', 'Next') ?> &nbsp;<span class="ti-arrow-circle-right"></span></a>
        </div>
        <div class="close"><a href="<?= Url::home() ?>" class="right">Close <span class="ti-close"></span></a></div>
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="des"><?= $model->description ?></div>

        <?php if(!empty($model->lean_more_link)) { ?>
        <p><a href="<?= Url::to($model->lean_more_link) ?>" class="more-btn button radius">Learn more</a></p>
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