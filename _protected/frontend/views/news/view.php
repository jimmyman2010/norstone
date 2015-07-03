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

$this->title = ucfirst($model->name) . ' | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->params['breadcrumbs'][] = $model->name;

ProductAsset::register($this);

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
        </div>
    </div>
</div>
