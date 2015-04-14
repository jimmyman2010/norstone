<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 3/24/2015
 * Time: 6:02 PM
 */

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * Class FullAsset
 * @package backend\assets
 */
class UploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'textext/css/textext.core.css',
        'textext/css/textext.plugin.autocomplete.css',
        'textext/css/textext.plugin.tags.css'

    ];
    public $js = [
        'plupload//plupload.full.min.js',
        'textext/js/textext.core.js',
        'textext/js/textext.plugin.autocomplete.js',
        'textext/js/textext.plugin.tags.js',
        'js/global.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'backend\assets\AppAsset'
    ];
}