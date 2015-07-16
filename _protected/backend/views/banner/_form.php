<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Content;
use yii\helpers\Url;
use backend\assets\PageBuilderAsset;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use yii\web\JsExpression;

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
            '" . Url::toRoute('banner/checkingduplicated') . "',
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

<div class="page-form row">

    <?php $form = ActiveForm::begin([
        'id' => 'action-form'
    ]); ?>

    <div class="large-8 columns">
        <?= $form->field($model, 'name')->textInput(['maxlength' => 256]) ?>
        <div class="form-group field-content-summary required">
            <label class="control-label" for="content-summary"><?= Yii::t('app', 'Banner') ?></label>
            <?= InputFile::widget([
                'controller' => 'elfinder',
                'path'       => 'image',
                'filter'     => 'image',
                'template'   => '<span class="clearfix"><span class="columns large-6">{input}</span><span class="columns large-6">{button}</span></span>',
                'name'       => 'Content[summary]',
                'id'         => 'content-summary',
                'value'      => $model->summary,
                'buttonOptions'     => ['class' => 'small button radius info']
            ]); ?>
        </div>
        <div class="form-group">
            <label class="control-label"><?= Yii::t('app', 'Link') ?></label>
            <input type="text" name="Content[content]" value="<?= $model->content ?>" />
        </div>
    </div>
    <div class="large-4 columns">
        <?= $form->field($model, 'sorting')->textInput() ?>
        <div class="form-group">
            <label class="control-label"><?= Yii::t('app', 'Position') ?></label>
            <select name="Content[parent_id]">
                <option value="0" <?php if($model->parent_id === 0) { echo 'selected="selected"'; } ?>><?= Yii::t('app', 'Left') ?></option>
                <option value="1" <?php if($model->parent_id === 1) { echo 'selected="selected"'; } ?>><?= Yii::t('app', 'Right') ?></option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <div class="action-buttons">
                <input type="hidden" name="type-submit" value="" />
                <?= Html::submitButton($model->status === Content::STATUS_DRAFT ? Yii::t('app', 'Publish') : Yii::t('app', 'Update'),
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
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
