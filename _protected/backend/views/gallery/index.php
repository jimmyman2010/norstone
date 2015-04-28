<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\UtilHelper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="gallery-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Create Gallery'), ['create'], ['class' => 'tiny button round']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body has-padding">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(['id' => 'colors']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => '#',
                'format' => 'html',
                'value' => function($data) {
                    $img = UtilHelper::getPicture($data->image, 'thumb-list', true);
                    return Html::a(Html::img($img, ['width'=>'100']), ['update', 'id' => $data->id]);
                }
            ],
            [
                'attribute'=>'name',
                'format'=>'html',
                'value'=> function($data) {
                    return Html::a($data->name, ['update', 'id' => $data->id]);
                }
            ],
            [
                'attribute' => 'product_id',
                'filter' => ArrayHelper::map($searchModel->getProducts(), 'id', 'name'),
                'value' => 'product.name'
            ],
            [
                'attribute' => 'color_id',
                'filter' => ArrayHelper::map($searchModel->getColors(), 'id', 'name'),
                'value' => 'color.name'
            ],
            [
                'attribute' => 'status',
                'filter' => $searchModel->getStatusList(),
                'value' => function($data) {
                    return $data->statusName;
                }
            ],
            // buttons
            ['class' => 'yii\grid\ActionColumn',
                'header' => "Menu",
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage gallery',
                            'class'=>'fa fa-pencil-square-o']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url,
                            ['title'=>'Delete gallery',
                                'class'=>'fa fa-trash-o',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this gallery?'),
                                    'method' => 'post']
                            ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>
    <?php Pjax::end() ?>

        </div>
    </div>
</article>
