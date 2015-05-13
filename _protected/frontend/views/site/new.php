<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $products array */
/* @var $colors array */
/* @var $tags array */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Yii::t('app', 'New Images');

?>
<section class="new welcome text-center">
    <h2><span>Check out our</span> New Images</h2>
    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
</section><!--end welcome-->
<section class="gallery-list">

    <div class="filter-gallery">

    </div>
    <?php Pjax::begin(['id' => 'galleries']) ?>

    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
        <?php
        $galleries = $dataProvider->getModels();
        if(count($galleries) === 0) {
            ?>
            <li class="no-results text-center">
                <h2>We are sorry but now image matched your search criteria</h2>
                <a class="button">Please try again</a>
            </li>
        <?php
        }
        else {
            foreach ($galleries as $index => $item) { ?>
                <li class="gallery-thumb">
                    <?= $this->render('../gallery/_item_details', ['model' => $item]) ?>
                </li>
            <?php }
        }
        ?>
    </ul>
    <nav class="text-center pagination-wrapper">
        <?= LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
            'nextPageLabel' => Yii::t('app', 'Newer') . '&nbsp; <span class="ti-arrow-right"></span>',
            'prevPageLabel' => '<span class="ti-arrow-left"></span> &nbsp;' . Yii::t('app', 'Previous'),
        ]) ?>
    </nav><!--end pagination-->
    <?php Pjax::end() ?>
</section><!--end gallery list-->


