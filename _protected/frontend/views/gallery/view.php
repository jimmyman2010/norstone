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
if($model->seo_keyword)
    $this->registerMetaTag(['name' => 'keywords', 'value' => $model->seo_keyword]);
if($model->seo_description)
    $this->registerMetaTag(['name' => 'description', 'value' => $model->seo_description]);
else
    $this->registerMetaTag(['name' => 'description', 'value' => 'Norstone. New dimensions in natural stone. Innovative natural stone products hand-crafted and designed to inspire you']);

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
        <p>
            <?php if(!empty($model->lean_more_link)) { ?>
            <a href="<?= Url::to($model->lean_more_link) ?>" target="_blank" class="more-btn button radius">Learn more</a>
            <?php } ?>
            <a href="<?= Url::toRoute('site/contact') ?>" class="more-btn contact-us button radius">
                <i class="ti-email"></i> <?= Yii::t('app', 'Contact us') ?>
            </a>
        </p>
        <ul class="info">
            <li><strong>Product name:</strong>
                <?= Html::a($model->product->name, ['site/index', 'product'=>$model->product_id], ['class'=> 'link']) ?>
            </li>
            <li><strong>Colour:</strong>
                <?= Html::a($model->color->name, ['site/index', 'color'=>$model->color_id], ['class'=> 'link']) ?>
            </li>
            <li><strong>Application:</strong>
                <?= Html::a($model->application ? Yii::t('app', 'Internal') : Yii::t('app', 'External'),
                    ['site/index', 'application'=>$model->application], ['class'=> 'link']) ?>
            </li>
            <li><strong>Tags:</strong>
                <?php foreach ($tags as $item) { ?>
                    <?= Html::a($item->name, ['site/index', 'tag'=>$item->id], ['class'=> 'label success round']) ?>
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
    <span class='st_googleplus_hcount' displayText='Google +'></span>
    <span class='st_pinterest_hcount' displayText='Pinterest'></span>
    <span class='st_email_hcount' displayText='Email'></span>
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
<?php }
$this->registerJs("var switchTo5x=true;");
$this->registerJs("stLight.options({publisher: \"f5aa822b-dd9d-40c5-ab1d-949e4ccb9e9c\", doNotHash: false, doNotCopy: false, hashAddressBar: false});");
