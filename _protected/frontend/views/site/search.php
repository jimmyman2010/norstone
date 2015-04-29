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

?>
    <div class="row">
        <div class="search-header">
            <h3 class="title"><?= Yii::t('app', 'Search results') ?></h3>
            <form method="get" action="<?= Url::toRoute('site/search') ?>">
                <div class="search-inline">
                    <input type="text" name="term" placeholder="Search" value="<?= Html::decode($_REQUEST['term']) ?>">
                    <button type="submit"><span class="ti-search"></span></button>
                </div>
            </form>
        </div>
<?php Pjax::begin(['id' => 'search-results']) ?>
<ul class="search-results">
    <?php
    $galleries = $dataProvider->getModels();
    if(count($galleries) === 0) {
        ?>
        <li class="text-center"><em><?= Yii::t('app', 'No results.') ?></em></li>
    <?php
    }
    else {
        foreach ($galleries as $index => $item) { ?>
            <li class="search-item">
                <?= $this->render('_search_item', ['model' => $item]) ?>
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
<?php
$this->registerJs("
    $('.search-results').highlight(\"" . Html::decode($_REQUEST['term']) . "\");
");
?>

<?php Pjax::end() ?>
    </div>