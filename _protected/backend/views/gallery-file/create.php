<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GalleryFile */

$this->title = Yii::t('app', 'Create Gallery File');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
