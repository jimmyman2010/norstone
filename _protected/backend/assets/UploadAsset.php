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
        'plupload/jquery.ui.plupload/css/jquery.ui.plupload.css'

    ];
    public $js = [
        'plupload/plupload.full.min.js',
        'js/app/upload.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'backend\assets\AppAsset'
    ];
}