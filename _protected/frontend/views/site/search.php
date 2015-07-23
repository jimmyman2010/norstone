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
use common\helpers\UtilHelper;
use \common\models\Config;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider; */

SearchAsset::register($this);

$this->title = Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li><a href="index.php" class="homepage-link" title="Back to the frontpage">Home</a></li>
        <li><span class="page-title">Contacts</span></li>
    </ul>

    <?php Pjax::begin(['id' => 'products']) ?>
    <div id="searchresults" class="search-scope">
        <h2 class="page_heading">KẾT QUẢ TÌM KIẾM CHO "<?= Html::decode($_REQUEST['term']) ?>"</h2>

        <form action="<?= Url::toRoute(['site/search']) ?>" method="get" class="search-form form-inline" role="search">
            <div class="form-group">
                <label for="term" class="sr-only">Tìm kiếm: </label>
                <input class="form-control" type="text" name="term" value="<?= Html::decode($_REQUEST['term']) ?>" placeholder="Search" />
            </div>
            <div class="form-group">
                <input type="submit" value="Tìm kiếm" class="btn btn-primary"/>
            </div>
        </form>

        <ol class="search-results">
            <?php
            $products = $dataProvider->getModels();
            if(count($products) === 0) {
                ?>
                <li class="no-results text-center">
                    <h2>We are sorry but now image matched your search criteria</h2>
                    <a class="button">Please try again</a>
                </li>
            <?php
            }
            else {
                foreach ($products as $index => $item) { ?>
                    <li class="search-result">
                        <div class="product_name">
                            <?= Html::a($item->name, ['product/view', 'id' => $item->id, 'slug' => $item->slug]) ?>
                        </div>
                        <div class="search-result_container">

                            <div class="search-result_image pull-left">
                                <a href="<?= Url::toRoute(['product/view', 'id' => $item->id, 'slug' => $item->slug]) ?>" title="<?= $item->name ?>">
                                    <?= UtilHelper::getPicture($item->image_id, 'thumbnail-search') ?>
                                </a>
                            </div>

                            <div class="product_desc"><?= strip_tags($item->description) ?></div>
                        </div>
                    </li>
                <?php }
            }
            ?>


        </ol>
        <nav class="pagination">
            <?= LinkPager::widget([
                'pagination'=>$dataProvider->pagination,
                'nextPageLabel' => 'Trang kế tiếp &raquo;',
                'prevPageLabel' => '&laquo; Quay lại',
            ]) ?>
        </nav>
    </div>
    <?php Pjax::end() ?>
</div>

<?php
$this->registerJs("
    $('.search-results').highlight(\"" . Html::decode($_REQUEST['term']) . "\");
");