<?php

Yii::setAlias('backend', dirname(__DIR__));
$baseUrl = 'https://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
//define('BACKEND', $baseUrl);

return [
    'id' => 'app-backend',
    'name' => 'FB & Defects',
    'basePath' => dirname(__DIR__),
   	// 'defaultRoute' => 'admin/default/index',
   	'defaultRoute' =>  Yii::$app->user->identity->role == 'superadmin' ? '/fb-booking-booked/dashboard' : '/fb-booking-booked/today' ,
    'modules' => [
        'admin' => [
            'class' => 'vova07\admin\Module'
        ],
		/*'gallery' => [
            'class' => 'app\modules\gallery\GalleryModule',
        ],*/
        'users' => [
            'controllerNamespace' => 'vova07\users\controllers\backend'
        ],
        'blogs' => [
            'isBackend' => true
        ],
        'comments' => [
            'isBackend' => true
        ],
        'rbac' => [
            'class' => 'vova07\rbac\Module',
            'isBackend' => true
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '7fdsf%dbYd&djsb#sn0mlsfo(kj^kf98dfh',
             'baseUrl' => $baseUrl
        ],
        'urlManager' => [
            'rules' => [
                '' => 'admin/default/index',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ]
        ],
        'view' => [
            'theme' => 'vova07\themes\admin\Theme'
        ],
        'errorHandler' => [
            'errorAction' => 'admin/default/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ]
    ],
    'params' => require(__DIR__ . '/params.php')
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.*'],
    ];
}
