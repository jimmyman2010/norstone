<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<article class="product-update">

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'tiny button round secondary']) ?></li>
                    <li><?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'tiny button round secondary']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body has-padding">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</article>
