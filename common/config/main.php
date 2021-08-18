<?php

ini_set("memory_limit", "-1");
set_time_limit(0);


return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Singapore',
    'modules' => [
        'users' => [
            'class' => 'vova07\users\Module',
            'robotEmail' => 'no-reply@ardmorepark.com.sg',
            'robotName' => 'Ardmorepark'
        ],
        'blogs' => [
            'class' => 'vova07\blogs\Module'
        ],
        'comments' => [
            'class' => 'vova07\comments\Module'
        ],
		'menu' => [
            'class' => '\pceuropa\menu\Module',
        ],
		'gallery' => [
			'class' => 'sadovojav\gallery\Module',
		],
		   'gridview' =>  [
			'class' => '\kartik\grid\Module'
		],
		'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
        ],
		'seomanager' => [
            'class' => 'julianb90\seomanager\Module',
        ],
		 'sliderrevolution' => [
			'class' => 'wadeshuler\sliderrevolution\SliderModule',
			'pluginLocation' => '@frontend/views/private/rs-plugin',    // <-- path to your rs-plugin directory
		],
    ],
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'vova07\users\models\User',
            'loginUrl' => ['/users/guest/login']
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@root/cache',
            'keyPrefix' => 'yii2start'
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'enableStrictParsing' => true,
            'showScriptName' => true,
            'suffix' => '/'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.demo.facilitybooking.com.sg',
                'username' => 'noreply@demo.facilitybooking.com.sg',
                'password' => 'hZrF1aq3QT',
                'port' => '587',
                //'encryption' => 'tls',
            ],
        ],

        'assetManager' => [
            'linkAssets' => true
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => [
                'user'
            ],
            'itemFile' => '@vova07/rbac/data/items.php',
            'assignmentFile' => '@vova07/rbac/data/assignments.php',
            'ruleFile' => '@vova07/rbac/data/rules.php',
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.y',
            'datetimeFormat' => 'HH:mm:ss dd.MM.y'
        ],
        'db' => require(__DIR__ . '/db.php')
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
