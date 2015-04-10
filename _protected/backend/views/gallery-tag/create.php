<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GalleryTag */

$this->title = Yii::t('app', 'Create Gallery Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
