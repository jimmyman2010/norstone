<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Content;
use yii\helpers\Url;
use backend\assets\PageBuilderAsset;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $contentElement common\models\ContentElement */
/* @var $form yii\widgets\ActiveForm */

PageBuilderAsset::register($this);

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

    <br/>
    <div class="page-builder" data-href="<?= Url::toRoute(['content-element/index', 'contentId' => $model->id]) ?>">
        <div class="controls">
            <?= Html::a('', ['content-element/create', 'contentId' => $model->id, 'type' => 'row'], ['class' => 'add-e-pb fa fa-plus', 'title' => 'Add new row']) ?>
        </div>
    </div>
    <br/>

    <div class="action-buttons">
        <input type="hidden" name="type-submit" value="" />
        <?= Html::submitButton($model->id ? Yii::t('app', 'Update') : Yii::t('app', 'Publish'),
            [
                'class' => 'small button radius',
                'data' => ['submit' => 1]
            ]) ?>
        <?php if($model->status === null || $model->status === Content::STATUS_DRAFT) { ?>
            <?= Html::submitButton($model->id ? Yii::t('app', 'Update Draft') : Yii::t('app', 'Save Draft'),
                [
                    'class' => 'small button radius info',
                    'data' => ['submit' => 0]
                ]) ?>
        <?php } ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
