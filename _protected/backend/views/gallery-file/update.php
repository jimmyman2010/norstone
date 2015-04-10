<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryFile */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gallery File',
]) . ' ' . $model->gallery_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gallery_id, 'url' => ['view', 'gallery_id' => $model->gallery_id, 'file_id' => $model->file_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gallery-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
