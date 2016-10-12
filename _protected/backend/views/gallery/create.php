<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = Yii::t('app', 'Create Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="gallery-create">

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'tiny button round secondary']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body">

    <?= $this->render('_form', [
        'model' => $model,
        'pictures' => $pictures,
        'tags' => $tags,
        'tagSuggestions' => $tagSuggestions,
        'galleries' => $galleries,
        'gallerySuggestion' => $gallerySuggestion
    ]) ?>

        </div>
    </div>
</article>
