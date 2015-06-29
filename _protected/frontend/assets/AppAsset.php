<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';
    
    public $css = [
        'assets/css/bootstrap.css',
        'assets/css/assets.css',
        'assets/css/style.css',
        'assets/css/responsive.css',
        'assets/css/font-awesome.css'
    ];
    public $js = [
        'assets/js/option_selection-061817d967a41963a33781f729f22ebf.js',
        'assets/js/bootstrap.min.js',
        //'assets/js/jquery.mobile.customized.min.js',
        'assets/js/shop.js',
        'assets/js/jquery.easing.1.3.js',
        'assets/js/api.jquery.js',
        'assets/js/ajaxify-shop.js',
        'assets/js/hoverIntent.js',
        'assets/js/superfish.js',
        'assets/js/supersubs.js',
        'assets/js/jquery.mobilemenu.js',
        'assets/js/sftouchscreen.js',
        'assets/js/jquery.caroufredsel.min.js',
        'assets/js/jquery.nivoslider.js',
        'assets/js/jquery.customSelect.min.js',

        'assets/js/currencies.js',
        'assets/js/jquery.currencies.min.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

