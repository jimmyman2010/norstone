<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryTag */

$this->title = $model->gallery_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-tag-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'gallery_id' => $model->gallery_id, 'tag_id' => $model->tag_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'gallery_id' => $model->gallery_id, 'tag_id' => $model->tag_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gallery_id',
            'tag_id',
        ],
    ]) ?>

</div>
