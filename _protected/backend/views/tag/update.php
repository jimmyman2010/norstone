<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tag',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<article class="tag-update">

    <div class="portlet large-6">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="portlet-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div>
    </div>
</article>
