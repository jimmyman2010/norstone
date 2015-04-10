<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryTag */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gallery Tag',
]) . ' ' . $model->gallery_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gallery_id, 'url' => ['view', 'gallery_id' => $model->gallery_id, 'tag_id' => $model->tag_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gallery-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
