<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Content;
use yii\helpers\Url;
use backend\assets\PageBuilderAsset;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

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
            '" . Url::toRoute('widget/checkingduplicated') . "',
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

    <div class="large-12 columns">
        <div class="row">
            <div class="large-9 columns">
                <?= $form->field($model, 'name')->textInput(['maxlength' => 256]) ?>
                <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        'inline' => false,
                        'language' => 'en',
                        'toolbar' => [
                            ['name' => 'styles', 'items' => [ 'Format' ]],
                            ['name' => 'basicstyles', 'items' => [ 'Bold', 'Italic', 'Underline', '-', 'RemoveFormat' ]],
                            ['name' => 'links', 'items' => [ 'Link', 'Unlink', 'Anchor' ]],
                            ['name' => 'clipboard', 'items' => ['Undo', 'Redo']],
                            ['name' => 'tools', 'items' => [ 'Maximize' ]],
                        ],
                        'removePlugins' => 'elementspath',
                        'resize_enabled' => false,
                        'height' => 300
                    ],
                ]) ?>
            </div>
            <div class="large-3 columns">
                <div>
                    <h6><?= Yii::t('app', 'Pictures') ?></h6>
                    <div id="filelist" class="view-thumbnail row">
                        <?php
                        foreach ($pictures as $index => $item) {
                            ?>
                            <div id="<?= $item->id ?>" class="photo-zone columns">
                                <table cellpadding="0" cellspacing="0">
                                    <tr><td class="controls">
                                            <label><input type="radio" name="Content[image_id]" value="<?= $item->id ?>" <?php if(intval($item->id) === intval($model->image_id)) echo 'checked="checked"'; ?> /> <?= Yii::t('app', 'Main picture') ?></label>
                                            <a class="delete-image" data-id="<?= $item->id ?>" href="javascript:;"><i class="fa fa-trash-o"></i></a>
                                        </td></tr>
                                    <tr><td class="edit"><span class="name">
                                            <img src="<?= $item->show_url ?><?= $item->name ?>-thumb-upload.<?= $item->file_ext ?>" alt="<?= $item->name ?>" />
                                        </span></td></tr>
                                    <tr><td class="caption">
                                            <textarea rows="4" name="Picture[<?= $item->id ?>][caption]" placeholder="Say something about this photo."><?= $item->caption ?></textarea>
                                            <input type="hidden" name="Picture[<?= $item->id ?>][id]" value="<?= $item->id ?>"/>
                                        </td></tr>
                                </table></div>
                        <?php } ?>
                    </div>
                    <div id="uploader" data-upload-link="<?=Url::toRoute('image/create')?>">
                        <a id="pickfiles" href="javascript:;" class="tiny button radius">Select files</a>
                    </div>
                    <pre id="console"></pre>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="action-buttons">
                    <input type="hidden" name="type-submit" value="" />
                    <?= Html::submitButton($model->status === Content::STATUS_DRAFT ? 'Hiển thị' : 'Cập nhật',
                        [
                            'class' => 'small button radius',
                            'data' => ['submit' => 1]
                        ]) ?>
                    <?php if($model->status === null || $model->status === Content::STATUS_DRAFT) { ?>
                        <?= Html::submitButton($model->id ? 'Cập nhật tạm' : 'Lưu tạm',
                            [
                                'class' => 'small button radius info',
                                'data' => ['submit' => 0]
                            ]) ?>
                    <?php } ?>
                    <?= Html::a('Bỏ qua', ['index'], ['class' => 'small button secondary radius']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
