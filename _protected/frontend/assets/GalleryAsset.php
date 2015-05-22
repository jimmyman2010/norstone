<?php
/**
 * Created by PhpStorm.
 * User: tdmman
 * Date: 4/23/2015
 * Time: 6:24 PM
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * Class GalleryAsset
 * @package frontend\assets
 */
class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'bower_components/fancyBox/source/jquery.fancybox.css'
    ];
    public $js = [
        'bower_components/touchSwipe/jquery.touchSwipe.min.js',
        'bower_components/fancyBox/source/jquery.fancybox.pack.js',
        'js/app.min.js',
        'http://w.sharethis.com/button/buttons.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset'
    ];
}
