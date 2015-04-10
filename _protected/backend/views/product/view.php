<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="product-view">

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
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this product?'),
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
        ],
    ]) ?>

        </div>
    </div>

</article>
