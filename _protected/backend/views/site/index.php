<?php

use backend\assets\ArrangementAsset;

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
            <div class="medium-6 columns search">
                <div class="portlet small">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-flash"></i><?= Yii::t('app', 'Arrangement of Featured Products') ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul id="sortable2" class="sortable grid">
                            <li draggable="true">Item 1
                            </li>
                            <li draggable="true">Item 2
                            </li>
                            <li draggable="true">Item 3
                            </li>
                            <li draggable="true">Item 4
                            </li>
                            <li draggable="true">Item 5
                            </li>
                            <li draggable="true">Item 6
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

