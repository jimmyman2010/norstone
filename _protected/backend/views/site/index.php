<?php

use backend\assets\ArrangementAsset;
use common\helpers\UtilHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = Yii::t('app', Yii::$app->name);

ArrangementAsset::register($this);

?>

<article class="site-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">Homepage</div>
        </div>
        <div class="portlet-body row">
            <div class="medium-12 columns">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-flash"></i><?= Yii::t('app', 'Arrangement of Featured Products') ?>
                        </div>
                    </div>
                    <div class="portlet-body feature-products">
                        <div class="medium-6 columns related">
                            <div class="portlet small">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-check"></i><?= Yii::t('app', 'Featured Products') ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul class="connected list sortable grid" id="arrangementSelected">
                                        <?php foreach ($products as $index => $item) {
                                            $img = UtilHelper::getPicture($item->image, 'thumb-list', true);
                                            ?>
                                            <li data-id="<?= $item->id ?>" title="<?= $item->name ?>">
                                                <img src="<?= $img ?>" alt="" />
                                                <a href="javascript:;"><?= $item->name ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="medium-6 columns search">
                            <div class="portlet small">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-database"></i><?= Yii::t('app', 'All Products') ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="search-box">
                                        <input type="text" placeholder="Enter keyword" />
                                    </div>
                                    <ul class="connected list no2">
                                        <?php foreach ($productSuggestion as $index => $item) {
                                            $img = UtilHelper::getPicture($item->image, 'thumb-list', true);
                                            ?>
                                            <li data-id="<?= $item->id ?>" title="<?= $item->name ?>">
                                                <img src="<?= $img ?>" alt="" />
                                                <a href="javascript:;"><?= $item->name ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'arrangement-form'
                                ]); ?>
                                <input id="arrangementProduct" type="hidden" name="ArrangementProduct" value="" />
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'small button radius']) ?>
                                <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i><?= Yii::t('app', 'Configuration') ?>
                        </div>
                    </div>
                    <div class="portlet-body has-padding-full">
                        <?php $form = ActiveForm::begin([
                            'id' => 'config-form'
                        ]); ?>

                        <?php foreach ($config as $index => $item) { ?>
                            <div class="form-group">
                                <label class="control-label" for="config-item-<?= $index+1 ?>"><?= Yii::t('app', $item->key) ?></label>
                                <?= Html::input('text', 'Config['.$item->key.']', $item->value, ['class' => 'form-control', 'id' => 'config-item-'.($index+1)]) ?>
                            </div>
                        <?php } ?>

                        <div class="action-buttons">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'small button radius']) ?>
                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i><?= Yii::t('app', 'SEO Global') ?>
                        </div>
                    </div>
                    <div class="portlet-body has-padding-full">
                        <?php $form = ActiveForm::begin([
                            'id' => 'seo-form'
                        ]); ?>

                        <?php foreach ($seo as $index => $item) { ?>
                            <div class="form-group">
                                <label class="control-label" for="config-item-<?= $index+1 ?>"><?= Yii::t('app', $item->key) ?></label>
                                <?= Html::textarea('Seo['.$item->key.']', $item->value, ['class' => 'form-control', 'rows' => $index+3, 'id' => 'config-item-'.($index+1)]) ?>
                            </div>
                        <?php } ?>

                        <div class="action-buttons">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'small button radius']) ?>
                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i><?= Yii::t('app', 'Social Configuration') ?>
                        </div>
                    </div>
                    <div class="portlet-body has-padding-full">
                        <?php $form = ActiveForm::begin([
                            'id' => 'social-form'
                        ]); ?>

                        <?php foreach ($social as $index => $item) { ?>
                            <div class="form-group">
                                <label class="control-label" for="config-item-<?= $index+1 ?>"><?= Yii::t('app', $item->key) ?></label>
                                <?= Html::input('text', 'Social['.$item->key.']', $item->value, ['class' => 'form-control', 'id' => 'social-item-'.($index+1)]) ?>
                            </div>
                        <?php } ?>

                        <div class="action-buttons">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'small button radius']) ?>
                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="medium-6 columns">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i><?= Yii::t('app', 'Social Configuration') ?>
                        </div>
                    </div>
                    <div class="portlet-body has-padding-full">
                        <?php $form = ActiveForm::begin([
                            'id' => 'social-form'
                        ]); ?>

                        <?php foreach ($support as $index => $item) { ?>
                            <div class="form-group">
                                <label class="control-label" for="config-item-<?= $index+1 ?>"><?= Yii::t('app', $item->key) ?> (separate by comma)</label>
                                <?= Html::input('text', 'Support['.$item->key.']', $item->value, ['class' => 'form-control', 'id' => 'support-item-'.($index+1)]) ?>
                            </div>
                        <?php } ?>

                        <div class="action-buttons">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'small button radius']) ?>
                            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'small button secondary radius']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

