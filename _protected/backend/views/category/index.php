<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="category-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'tiny button round']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body has-padding">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php Pjax::begin(['id' => 'categories']) ?>
            <table class="table table-striped table-bordered"><thead>
                <tr>
                    <th>#</th>
                    <th><a href="javascript:;">Name</a></th>
                    <th>Menu</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($result as $index => $item) { ?>
                    <tr data-key="5">
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?= Html::a($item['name'], ['update', 'id' => $item['id']]) ?>
                        </td>
                        <td>
                            <?= Html::a('', ['update', 'id' => $item['id']],
                                ['class' => 'fa fa-pencil-square-o', 'title' => 'Manage category']) ?>
                            <?= Html::a('', ['delete', 'id' => $item['id']],
                                ['class' => 'fa fa-trash-o', 'title' => 'Delete category', 'data-confirm'=>"Are you sure you want to delete this category?", 'data-method'=>"post"]) ?>
                        </td>
                    </tr>
                    <?php foreach($item['children'] as $inx => $child) { ?>
                        <tr data-key="5">
                            <td></td>
                            <td style="padding-left: 50px">
                                <?= Html::a($child->name, ['update', 'id' => $child->id]) ?>
                            </td>
                            <td>
                                <?= Html::a('', ['update', 'id' => $child->id],
                                    ['class' => 'fa fa-pencil-square-o', 'title' => 'Manage category']) ?>
                                <?= Html::a('', ['delete', 'id' => $child->id],
                                    ['class' => 'fa fa-trash-o', 'title' => 'Delete category', 'data-confirm'=>"Are you sure you want to delete this category?", 'data-method'=>"post"]) ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody></table>
            <?php Pjax::end() ?>
        </div>
    </div>
</article>
