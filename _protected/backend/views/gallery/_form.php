<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

use backend\assets\GalleryAsset;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\Color;
use common\models\Gallery;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */

GalleryAsset::register($this);

$this->registerJs("
    $('#gallery-name').on('blur', function(){
        var that = $(this),
            name = $(this).val();
        $.get(
            '" . Url::toRoute('gallery/checkingduplicated') . "',
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
");

?>

<div class="gallery-form row">

    <?php $form = ActiveForm::begin([
        'id' => 'gallery-form'
    ]); ?>

    <div class="large-12 columns">
        <ul class="tabs" data-tab role="tablist">
            <li class="tab-title active" role="presentational" >
                <a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" controls="panel2-1">
                    <?=Yii::t('app', 'Contents') ?>
                </a>
            </li>
            <li class="tab-title" role="presentational" >
                <a href="#panel2-2" role="tab" tabindex="0"aria-selected="false" controls="panel2-2">
                    <?=Yii::t('app', 'Pictures') ?>
                </a>
            </li>
            <li class="tab-title" role="presentational">
                <a href="#panel2-3" role="tab" tabindex="0" aria-selected="false" controls="panel2-3">
                    <?=Yii::t('app', 'SEO') ?>
                </a>
            </li>
            <li class="tab-title" role="presentational" >
                <a href="#panel2-4" role="tab" tabindex="0" aria-selected="false" controls="panel2-4">
                    <?=Yii::t('app', 'Related galleries') ?>
                </a>
            </li>
        </ul>
        <div class="tabs-content">
            <section role="tabpanel" aria-hidden="false" class="row content active" id="panel2-1">
                <div class="large-8 columns">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 256]) ?>
                    <?= $form->field($model, 'intro')->textarea(['maxlength' => 1024, 'rows' => 3]) ?>
                    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                        'editorOptions' => [
                            'inline' => false,
                            'language' => 'en',
                            'toolbar' => [
                                ['name' => 'styles', 'items' => [ 'Format' ]],
                                ['name' => 'basicstyles', 'items' => [ 'Bold', 'Italic', 'Underline', '-', 'RemoveFormat' ]],
                                ['name' => 'paragraph', 'items' => [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']],
                                ['name' => 'links', 'items' => [ 'Link', 'Unlink', 'Anchor' ]],
                                ['name' => 'tools', 'items' => [ 'Maximize' ]],
                                ['name' => 'clipboard', 'items' => ['Undo', 'Redo']],
                            ],
                            'removePlugins' => 'elementspath',
                            'resize_enabled' => false,
                        ],
                    ]) ?>

                    <?= $form->field($model, 'lean_more_link')->textInput(['maxlength' => 128]) ?>
                </div>
                <div class="large-4 columns">
                    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Product::findAll(['deleted'=>0]), 'id', 'name'), ['prompt'=>'- please select -']) ?>
                    <?= $form->field($model, 'color_id')->dropDownList(ArrayHelper::map(Color::findAll(['deleted'=>0]), 'id', 'name'), ['prompt'=>'- please select -']) ?>
                    <?= $form->field($model, 'application')->radioList(['0' => Yii::t('app', 'External'), '1' => Yii::t('app', 'Internal')]) ?>
                    <div class="form-group field-gallery-tags">
                        <label>Tags</label>
                        <textarea id="tags" rows="1" name="Tag" data-value='<?= Html::decode($tags) ?>' data-suggestions="<?= Html::decode($tagSuggestions) ?>"></textarea>
                    </div>
                </div>
            </section>
            <section role="tabpanel" aria-hidden="true" class="row content" id="panel2-2">
                <div class="large-12 columns">
                    <div id="filelist" class="view-thumbnail row">
                        <?php
                        foreach ($pictures as $index => $item) {
                            ?>
                            <div id="<?= $item->id ?>" class="photo-zone large-4 medium-6 columns">
                                <table cellpadding="0" cellspacing="0">
                                    <tr><td class="controls">
                                            <label><input type="radio" name="Gallery[image_id]" value="<?= $item->id ?>" <?php if(intval($item->id) === intval($model->image_id)) echo 'checked="checked"'; ?> /> Main picture</label>
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
            </section>
            <section role="tabpanel" aria-hidden="true" class="row content" id="panel2-3">
                <div class="columns">
                    <?php if($model->slug !== null) { ?>
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => 128]) ?>
                    <?php } ?>
                    <?= $form->field($model, 'seo_keyword')->textarea(['maxlength' => 128, 'rows' => 2]) ?>
                    <?= $form->field($model, 'seo_description')->textarea(['maxlength' => 256, 'rows' => 5]) ?>
                </div>
            </section>
            <section role="tabpanel" aria-hidden="true" class="row content" id="panel2-4">
                <input id="relatedGallery" type="hidden" name="Related" value="" />
                <div class="medium-6 columns related">
                    <div class="portlet small">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Related Galleries
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="connected list">
                                <?php foreach ($galleries as $index => $item) { ?>
                                    <li data-id="<?= $item->id ?>"><a href="javascript:;"><?= $item->name ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="medium-6 columns search">
                    <div class="portlet small">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>All Galleries
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="search-box">
                                <input type="text" placeholder="Enter keyword" />
                            </div>
                            <ul class="connected list no2">
                                <?php foreach ($gallerySuggestion as $index => $item) { ?>
                                    <li data-id="<?= $item->id ?>"><a href="javascript:;"><?= $item->name ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <div class="gallery-buttons">
                <input type="hidden" name="type-submit" value="" />
                <?= Html::submitButton($model->id ? ($model->status === Gallery::STATUS_DRAFT) ? Yii::t('app', 'Publish') : Yii::t('app', 'Update') : Yii::t('app', 'Publish'),
                    [
                        'class' => 'small button radius',
                        'data' => ['submit' => 1]
                    ]) ?>
                <?php if($model->status === null || $model->status === Gallery::STATUS_DRAFT) { ?>
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
