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
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'bower_components/lightbox/css/lightbox.css'
    ];
    public $js = [
        'bower_components/lightbox/js/lightbox.min.js',
        'http://w.sharethis.com/button/buttons.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset'
    ];
}
