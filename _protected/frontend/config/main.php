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
            'suffix' => '.html',
            'rules' => [
                'san-pham-xem/<id:\d+>/<slug>' => 'product/view',
                'san-pham/<id:\d+>/<slug>' => 'product/category',
                'san-pham/tag/<slug>' => 'product/tag',
                'lien-he' => 'site/contact',
                'tin-tuc' => 'news/index',
                'tin-tuc/<slug>' => 'news/view',
                'tin-tuc/tag/<slug>' => 'news/tag',
                'tim-kiem' => 'site/search',
                '<slug>' => 'page/view',
                'defaultRoute' => 'site/index',
            ]
        ],
        'search' => [
            'class' => 'himiklab\yii2\search\Search',
            'models' => [
                'common\models\Search',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/vitinhgiatot/views'],
                'baseUrl' => '@web/themes/vitinhgiatot',
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
