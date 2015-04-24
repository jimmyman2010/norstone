<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
    ],
    'components' => [
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => __DIR__ . '/../../../assets',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XaF3GmqD-Z3O8trcZ00-7v3oi38_vmIH',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<slug>' => '<controller>/view',
                '<action:\w+>' => 'site/<action>'
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/norstone/views'],
                'baseUrl' => '@web/themes/norstone',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
