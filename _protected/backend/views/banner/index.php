<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banner');
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="page-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Create Banner'), ['create'], ['class' => 'tiny button round']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body has-padding">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php Pjax::begin(['id' => 'widgets']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'name',
                        'format'=>'html',
                        'value'=> function($data) {
                            return Html::a($data->name, ['update', 'id' => $data->id]);
                        }
                    ],
                    [
                        'header' => 'Position',
                        'value' => function($data) {
                            switch($data->parent_id) {
                                case 2:{
                                    return Yii::t('app', 'Sidebar');
                                    break;
                                }
                                case 1:{
                                    return Yii::t('app', 'Right');
                                    break;
                                }
                                case 0:
                                default: {
                                    return Yii::t('app', 'Left');
                                    break;
                                }
                            }
                        }
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
                                return Html::a('', $url, ['title'=>'Manage widget',
                                    'class'=>'fa fa-pencil-square-o']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('', $url,
                                    ['title'=>'Delete page',
                                        'class'=>'fa fa-trash-o',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this page?'),
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
