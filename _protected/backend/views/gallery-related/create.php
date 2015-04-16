<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GalleryRelated */

$this->title = Yii::t('app', 'Create Gallery Related');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Relateds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-related-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
