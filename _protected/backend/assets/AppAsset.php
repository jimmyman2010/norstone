<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 *
 * Customized by Nenad Živković
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';
    
    public $css = [
        'css/font-awesome.min.css',
        'css/foundation.min.css',
        'css/global.min.css',

    ];
    public $js = [
        'js/vendor/foundation.min.js',

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
