<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <div class="portlet-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => '#',
                'format' => 'html',
                'value' => function($data) {
                    if($data->image !== null)
                    {
                        $image = $data->image;
                        $img = $image->show_url . $image->file_name . '-thumb-list.' . $image->file_ext;
                    } else {
                        $img = '/admin/themes/jmgroup/images/NoImage_592x444.jpg';
                    }
                    return Html::img($img, ['width'=>'100']);
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
                'value' => 'product.name'
            ],
            [
                'attribute' => 'color_id',
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

        </div>
    </div>
</article>
