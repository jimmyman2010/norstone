<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/1/2015
 * Time: 3:16 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;
use frontend\assets\ProductAsset;
use yii\widgets\LinkPager;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $news common\models\Content */

$this->title = 'Tin tức | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'keywords', 'value' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'value' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

ProductAsset::register($this);

?>

<div id="main_content" class="col-sm-9">
    <div id="blog" class="blog-scope">

        <div class="page_header">
            <div class="pull-right feed-link">
                <a href="/blogs/news.atom" target="_blank"></a>
            </div>

            <h1 class="page_heading">Tin tức</h1>

        </div>

        <div class="page_content">
            <?php foreach ($dataProvider->getModels() as $index => $news) { ?>
                <div class="blog-article">
                    <div class="article_header">
                        <div class="blog-article_meta-comments">
                            <a href="blog-detail.php#comments">0 comments</a>
                        </div>
                        <div class="product_name">
                            <?= Html::a($news->name, ['news/view', 'id' => $news->id, 'slug' => $news->slug]) ?>
                        </div>
                        <div class="blog-article_date">
                            <span>Đăng ngày: </span>
                            <time pubdate datetime="2013-12-30">
                                <span class="day">Dec</span>
                                <span class="month">30</span>
                            </time>
                        </div>
                        <div class="blog-article_meta-tags">
                            <span>Tags: </span>
                            <a href="/blogs/news/tagged/apple">Apple</a>,
                            <a href="/blogs/news/tagged/computers">Computers</a>
                        </div>
                    </div>
                    <div class="rte">
                        <p style="text-align: left;">
                            <img style="margin-right: 15px;" src="uploads/acer_as5738z-4333_15-6-inch_laptop_1_compact.jpeg?v=1388409135" />
                            <img style="margin-right: 15px;" src="uploads/apple_macbook_pro_13_2-7ghz_i7_1_compact.jpeg?v=1388409139" />
                            <img style="margin-right: 15px;" src="uploads/dell_inspiron_1520_3_compact.jpeg?v=1388409117" />
                        </p>
                        <?= $news->summary ?>
                    </div>
                    <?= Html::a('Xem thêm', ['news/view', 'id' => $news->id, 'slug' => $news->slug], ['class' => 'blog-article_read-more btn btn-info']) ?>
                </div>
            <?php } ?>

            <nav class="pagination">
                <?= LinkPager::widget([
                    'pagination'=>$dataProvider->pagination,
                    'nextPageLabel' => 'Trang kế tiếp &raquo;',
                    'prevPageLabel' => '&laquo; Quay lại',
                ]) ?>
            </nav>
        </div>
    </div>
</div>
