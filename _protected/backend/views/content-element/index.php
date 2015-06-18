<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContentElementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php foreach ($rows as $irow => $model) { ?>

    <div class="pb-row">
        <?php foreach (Json::decode($model->content)['columns'] as $column) { ?>
            <div class="pb-column pb-col-<?= $column['col'] ?>">
                <div class="pb-column-content">

                    <div class="controls">
                        <?= Html::a('', '#', [
                            'class' => 'open-modal fa fa-th-list',
                            'title' => 'Edit columns',
                            'data' => [
                                'reveal-id' => 'modalColumn',
                                'id' => $model->id,
                                'url-get' => Url::toRoute(['content-element/view', 'id' => $model->id]),
                                'url-post' => Url::toRoute(['content-element/update', 'id' => $model->id])
                            ]
                        ]) ?>
                        <?= Html::a('', '#', [
                            'class' => 'open-modal fa fa-plus',
                            'title' => 'Add new element',
                            'data' => [
                                'reveal-id' => 'modalAddElement',
                                'id' => $model->id,
                                'url-get' => Url::toRoute(['content-element/create', 'contentId' => $model->content_id])
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="controls">
            <?= Html::a('', '#', [
                'class' => 'open-modal fa fa-pencil-square-o',
                'title' => 'Edit row',
                'data' => [
                    'reveal-id' => 'modalEdit',
                    'id' => $model->id,
                    'url-get' => Url::toRoute(['content-element/view', 'id' => $model->id]),
                    'url-post' => Url::toRoute(['content-element/update', 'id' => $model->id])
                ]
            ]) ?>
            <?= Html::a('', ['content-element/active', 'id' => $model->id], ['class' => $model->hide === 1 ? 'active-e-row fa fa-toggle-off' : 'active-e-row fa fa-toggle-on', 'title' => 'Show/Hide row']) ?>
            <?= Html::a('', ['content-element/delete', 'id' => $model->id], ['class' => 'delete-e-row fa fa-times', 'title' => 'Delete row', 'data' => ['method' => 'post']]) ?>
        </div>
    </div>

<?php } ?>

<div id="modalEdit" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h3 id="modalTitle">Edit row</h3>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>

    <div class="row">
        <div class="columns">
            <label>Column
                <select>
                    <option value="[1]">1/1</option>
                    <option value="[1,1]">1/2 - 1/2</option>
                    <option value="[1,2]">1/3 - 2/3</option>
                    <option value="[1,1,1]">1/3 - 1/3 - 1/3</option>
                    <option value="[2,1]">2/3 - 1/3</option>
                    <option value="[1,3]">1/4 - 3/4</option>
                    <option value="[1,2,1]">1/4 - 2/4 - 1/4</option>
                    <option value="[1,1,2]">1/4 - 1/4 - 2/4</option>
                    <option value="[2,1,1]">2/4 - 1/4 - 1/4</option>
                    <option value="[3,1]">3/4 - 1/4</option>
                    <option value="[1,1,1,1]">1/4 - 1/4 - 1/4 - 1/4</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            <label>Extra classes
                <input type="text" placeholder="Extra classes" />
            </label>
        </div>
    </div>
    <div class="row button-group">
        <a class="button small radius"><?= Yii::t('app', 'Save') ?></a>
        <a class="button small radius secondary"><?= Yii::t('app', 'Save') ?></a>
    </div>
</div>

<div id="modalColumn" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Awesome. I have it.</h2>
    <p class="lead">Your couch.  It is mine.</p>
    <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="modalAddElement" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h3 id="modalTitle">Add new element</h3>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>

    <div class="row">
        <div class="columns">
            <label>Column
                <select>
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="textarea">Textarea</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            <label>Extra classes
                <input type="text" placeholder="Extra classes" />
            </label>
        </div>
    </div>
    <div class="row button-group">
        <a class="button small radius"><?= Yii::t('app', 'Save') ?></a>
        <a class="button small radius secondary"><?= Yii::t('app', 'Save') ?></a>
    </div>
</div>