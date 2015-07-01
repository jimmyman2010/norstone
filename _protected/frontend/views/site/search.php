<?php
/**
 * Created by PhpStorm.
 * User: tdmman
 * Date: 4/29/2015
 * Time: 10:05 AM
 */

use yii\widgets\LinkPager;
use frontend\assets\SearchAsset;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */

SearchAsset::register($this);

$this->title = Yii::t('app', 'Searching...') . ' | ' . Yii::t('app', Yii::$app->name);
$this->registerMetaTag(['name' => 'description', 'value' => 'Norstone. New dimensions in natural stone. Innovative natural stone products hand-crafted and designed to inspire you']);

?>
<section class="new welcome text-center">
    <h2><span>Search results for</span> "<?= Html::decode($_REQUEST['term']) ?>"</h2>
    <p>When images speak louder than words. </p>
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
<?php
$this->registerJs("
    $('.search-results').highlight(\"" . Html::decode($_REQUEST['term']) . "\");
");
