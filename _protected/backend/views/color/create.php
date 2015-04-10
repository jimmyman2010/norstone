<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Color */

$this->title = Yii::t('app', 'Create Color');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="color-create">

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
