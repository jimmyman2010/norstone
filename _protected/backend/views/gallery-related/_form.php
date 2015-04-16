<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryRelated */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-related-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gallery_id')->textInput() ?>

    <?= $form->field($model, 'related_id')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
