<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
    $('#category-name').on('blur', function(){
        var that = $(this),
            name = $(this).val();
        $.get(
            '" . Url::toRoute('category/checkingduplicated') . "',
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

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'slug')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($model->getParents($model->id), 'id', 'name'), ['prompt'=>'- please select -']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'small button radius']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
