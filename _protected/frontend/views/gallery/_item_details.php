<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;

?>

<div class="gallery-img">
    <a href="<?= Url::toRoute(['gallery/view', 'id' => $model->id])?>">
        <?= UtilHelper::getPicture($model->image, 'thumbnail') ?>
        <span class="ti-fullscreen"></span>
    </a>
</div>
<h4><?= Html::a($model->name, ['gallery/view', 'id' => $model->id]) ?></h4>
<p><?= $model->intro ?><?= Html::a(Yii::t('app', '...more'), ['gallery/view', 'id' => $model->id]) ?></p>