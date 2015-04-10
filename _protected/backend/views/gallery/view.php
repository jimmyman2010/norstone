<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="gallery-view">

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'tiny round button secondary']) ?></li>
                    <li><?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], [
                            'class' => 'tiny round button']) ?>
                    </li>
                    <li><?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'tiny round button alert',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this gallery?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="portlet-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'product_id',
            'color_id',
            'application',
            'intro',
            'description:ntext',
            'lean_more_link',
            'status',
            'publish_date',
            'created_date',
            'created_by'
        ],
    ]) ?>
        </div>
    </div>

</article>
