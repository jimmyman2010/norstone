<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 5/12/2015
 * Time: 8:33 AM
 */

$config = [
    'components' => [
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;