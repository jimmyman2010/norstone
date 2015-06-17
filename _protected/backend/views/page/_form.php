<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Content;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
    $('#content-name').on('blur', function(){
        var that = $(this),
            name = $(this).val();
        $.get(
            '" . Url::toRoute('page/checkingduplicated') . "',
            {'name': name" . ($model->id ? ", 'id': $model->id" : '') . "},
            function(data){
                if(data === true){
                    that.parent().removeClass('duplicated');
                } else {
                    that.parent().addClass('duplicated');
                }
            }
        );
    });
    $('.field-content-slug').on('click', function(){
        $(this).children('input')
            .prop('disabled', false)
            .focus();
    });
");

?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'id' => 'action-form'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 256]) ?>

    <?php if($model->slug !== null) { ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => 128, 'disabled' => 'disabled']) ?>
    <?php } ?>

    <div class="action-buttons">
        <input type="hidden" name="type-submit" value="" />
        <?= Html::submitButton($model->id ? Yii::t('app', 'Update') : Yii::t('app', 'Publish'), ['class' => 'small button radius']) ?>
        <?php if($model->status === null || $model->status === Content::STATUS_DRAFT) { ?>
            <?= Html::submitButton($model->id ? Yii::t('app', 'Update Draft') : Yii::t('app', 'Save Draft'), ['class' => 'small button radius info']) ?>
        <?php } ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
