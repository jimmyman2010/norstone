<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="product-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'tiny button round']) ?></li>
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
            'name',
            // buttons
            ['class' => 'yii\grid\ActionColumn',
                'header' => "Menu",
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage product',
                            'class'=>'fa fa-pencil-square-o']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url,
                            ['title'=>'Delete product',
                                'class'=>'fa fa-trash-o',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this product?'),
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
