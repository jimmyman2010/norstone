<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = Yii::t('app', Yii::$app->name);
?>
<section class="welcome text-center">
    <h2><span>Norstone Image Gallery</span> When images speak louder than words</h2>
    <p>Welcome to our Norstone image gallery. We are excited to show you how can our eco friendly stone products contribute to a better aesthetics of architecture and spaces that surrounds us. Stone is universal material suitable for various applications. Use our <a href="#">"Choose the products"</a> searching tool to find inspiration you are looking for.</p>
</section><!--end welcome-->
<section class="gallery-list">
    <div class="filter-gallery">
        <div class="text-center"><span id="drop-view" data-target="drop-content">Choose the product</span></div>
        <div class="filter-content" id="drop-content" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
            <div class="row text-left">
                <div class="small-12 medium-12 large-4 columns text-center">
                    <div class="dropdown" data-dropdown="drop1" aria-expanded="false">Product name <span class="ti-angle-down"></span>
                    </div>
                    <ul id="drop1" class="f-dropdown text-left" data-dropdown-content aria-hidden="true" tabindex="-1">
                        <?php foreach ($products as $product) { ?>
                            <li><a href="javascript:;" data-id="<?= $product->id ?>"><?= $product->name ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="small-12 medium-12 large-4 columns text-center">

                    <div class="dropdown" data-dropdown="drop2" aria-expanded="false">Select the colour <span class="ti-angle-down"></span>
                    </div>
                    <ul id="drop2" class="f-dropdown text-left" data-dropdown-content aria-hidden="true" tabindex="-1">
                        <?php foreach ($colors as $color) { ?>
                            <li><a href="javascript:;" data-id="<?= $color->id ?>"><?= $color->name ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="small-12 medium-12 large-4 columns type-show text-center">
                    <input type="radio" name="choose" checked="true" value="Show All" id="show-all"><label for="show-all">Show all</label>
                    <input type="radio" name="choose" value="Internal" id="internal"><label for="internal">Internal</label>
                    <input type="radio" name="choose" value="External" id="external"><label for="external">Internal</label>
                </div>
            </div>
        </div>
    </div>
    <p class="line text-center"><span></span></p>
    <div class="tags text-center">
        <?php foreach ($tags as $tag) { ?>
            <a href="javascript:;" class="tag-name" data-id="<?= $tag->id ?>"><?= $tag->name ?></a>
        <?php } ?>
    </div>
    <?php Pjax::begin(['id' => 'galleries']) ?>
    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
        <?php foreach ($dataProvider->getModels() as $index => $item) { ?>
            <li class="gallery-thumb">
                <?= $this->render('../gallery/_item_details', ['model' => $item]) ?>
            </li>
        <?php } ?>
    </ul>
    <nav class="text-center pagination-wrapper">
        <?= LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
            'nextPageLabel' => Yii::t('app', 'Next') . '&nbsp; <span class="ti-arrow-right"></span>',
            'prevPageLabel' => '<span class="ti-arrow-left"></span> &nbsp;' . Yii::t('app', 'Previous'),
        ]) ?>
    </nav><!--end pagination-->
    <?php Pjax::end() ?>
</section><!--end gallery list-->


