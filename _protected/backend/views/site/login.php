<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
?>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <h3 class="form-title">Login to your account</h3>
    <?php //-- use email or username field depending on model scenario --// ?>

    <?php if (false): ?>
        <?= $form->field($model, 'email', ['template' => "{label}<div class='input-icon'><i class='fa fa-envelope'></i>{input}</div>{error}"])
            ->input('email', ['placeholder' => Yii::t('app', 'Email'), 'autocomplete'=>'off'])
            ->label(Yii::t('app', 'Email'), ['class'=>'control-label']) ?>
    <?php else: ?>
        <?= $form->field($model, 'username', ['template' => "{label}<div class='input-icon'><i class='fa fa-user'></i>{input}</div>{error}"])
            ->textInput(['placeholder' => Yii::t('app', 'Username'), 'autocomplete'=>'off'])
            ->label(Yii::t('app', 'Username'), ['class'=>'control-label']) ?>
    <?php endif ?>

    <?= $form->field($model, 'password', ['template' => "{label}<div class='input-icon'><i class='fa fa-lock'></i>{input}</div>{error}"])
        ->passwordInput(['placeholder' => Yii::t('app', 'Password'), 'autocomplete'=>'off'])
        ->label(Yii::t('app', 'Password'), ['class'=>'control-label']) ?>

    <div class="form-actions clearfix">
        <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<label class='checkbox'>{input}{label}</label>"]) ?>
        <?= Html::submitButton(Yii::t('app', 'Login') . '&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>', ['class' => 'btn green-haze pull-right', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

