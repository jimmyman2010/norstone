<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;

/* @var $model common\models\Gallery; */

?>

<a href="<?= Url::toRoute(['gallery/view', 'slug' => $model->slug])?>">
    <?= UtilHelper::getPicture($model->image, 'thumbnail-search') ?>
</a>
<h4><?= Html::a($model->name, ['gallery/view', 'slug' => $model->slug]) ?></h4>
<p><?= $model->intro ?><?= Html::a(Yii::t('app', '...more'), ['gallery/view', 'slug' => $model->slug]) ?></p>