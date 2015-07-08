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
use yii\widgets\Breadcrumbs;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $model common\models\Content */

ProductAsset::register($this);

$this->title = !empty($model->seo_title) ? $model->seo_title : $model->name . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => !empty($model->seo_keyword) ? $model->seo_keyword : Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => !empty($model->seo_description) ? $model->seo_description : Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <li><a href="<?= Url::toRoute(['news/index']) ?>">Tin tức</a></li>
        <li class="lastItem"><span class="page-title"><?= $model->name ?></span></li>
    </ul>
    <div class="page-scope">
        <div class="page_header">
            <h1 class="page_heading"><?= $model->name ?></h1>
        </div>
        <div class="page_content">
            <div class="rte">
                <?= $model->content ?>
            </div>
            <?php if(count($tags) > 0) { ?>
            <div class="blog-article_meta-tags">
                <span>Tags: </span>
                <?php
                }
                foreach ($tags as $index => $tag) {
                    if($index > 0)
                        echo ', ';
                    echo Html::a($tag->name, ['news/tag', 'slug' => $tag->slug]);
                }
                ?>
            <?php if(count($tags) > 0) { ?>
            </div>
            <?php } ?>

            <div class="widget widget__related-products" id="comments">
                <div class="widget_content">
                    <div class="fb-comments" data-version="v2.3" data-width="880px"></div>
                </div>

            </div>
        </div>
    </div>
</div>
