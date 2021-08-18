<?php
//print_r($_SERVER);
use \yii\web\Request;

$baseUrl = 'https://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
//$baseUrl = str_replace('/frontend', '', $baseUrl);
//echo $baseUrl = str_replace('/frontend', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'name' => 'Ardmore Park',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'facilities/index',
    'modules' => [
        'site' => [
            'class' => 'vova07\site\Module'
        ],
        'blogs' => [
            'controllerNamespace' => 'vova07\blogs\controllers\frontend'
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'sdi8s#fnj98jwiqiw;qfh!fjgh0d8f',
            'baseUrl' => $baseUrl,
			'enableCsrfValidation' => false,
        ],
        'urlManager' => [
            'rules' => [
				'baseUrl' => '/',
				'enablePrettyUrl' => true,
            	'showScriptName' => true,
               // '' => 'site/default/index',
                //'<_a:(about|contacts|captcha)>' => 'site/default/<_a>'
            ]
        ],
		 'assetManager' => [
            'linkAssets' => false,
            //'forcecopy' => true,
			'bundles' => [
            'dosamigos\google\maps\MapAsset' => [
                'options' => [
                    'key' => 'AIzaSyAkZyruSX9SHZA1WAlO7b9dcTmX8pvXZG0',
                    'language' => 'en',
                    'version' => '3.1.18'
                ]
            ]
        ]
        ],
        'view' => [
            'theme' => 'vova07\themes\site\Theme'
        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
		
		'user'=> [
			'loginUrl' => ['/user/security/login'],
           //'allowAutoLogin' => false

		],
    ],
	 
	
	/*'as beforeRequest' => [
		'class' => 'yii\filters\AccessControl',
		'rules' => [
			[
				'actions' => ['login', 'error'],
				'allow' => true,
			],
			[
			
				'allow' => true,
				'roles' => ['@'],
			],
		],
	],  */


    'params' => require(__DIR__ . '/params.php')
];
