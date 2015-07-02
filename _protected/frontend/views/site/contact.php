<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Liên hệ | ' . Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="main_content" class="col-sm-9">
    <div class="contact-scope">
        <h1 class="page_heading">Liên hệ</h1>
        <div id="map-canvas"></div>
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div id="contactFormWrapper">
                <div class="row">
                    <?= $form->field($model, 'name', ['options' => ['class' => 'col-sm-4 form-group']]) ?>
                    <?= $form->field($model, 'email', ['options' => ['class' => 'col-sm-4 form-group']]) ?>
                    <?= $form->field($model, 'subject', ['options' => ['class' => 'col-sm-4 form-group']]) ?>
                </div>
                <div class="row">
                    <?= $form->field($model, 'body', ['options' => ['class' => 'col-sm-12 form-group']])->textArea(['rows' => 6]) ?>
                    <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'col-sm-12 form-group']])
                        ->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-sm-4">{image}</div><div class="col-sm-4">{input}</div></div>'
                        ]) ?>
                </div>
                <div class="form-group text-center">
                    <?= Html::submitButton(Yii::t('app', 'Gởi mail'), ['class' => 'btn btn-primary radius', 'name' => 'contact-button']) ?>
                    <input type="reset" value="Bỏ qua" class="btn btn-info">
                </div>
            </div><!-- contactFormWrapper -->
        <?php ActiveForm::end(); ?>
    </div>

</div>

<?php

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=vi');
$this->registerJs("

function initialize() {
  var mapOptions = {
    scaleControl: true,
    center: new google.maps.LatLng(" . Config::findOne(['key' => 'G_MAP'])->value . "),
    zoom: 17
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    position: map.getCenter()
  });
  var infowindow = new google.maps.InfoWindow();
  infowindow.setContent('Duy Tân Computer');
  google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

");