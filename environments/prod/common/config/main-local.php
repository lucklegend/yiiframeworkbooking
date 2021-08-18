<?php
return [
    'bootstrap' => [
        'debug',
        'gii'
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module'
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
			 'allowedIPs' => ['*'],
        ]
    ],
    'components' => [
        'db' => require(__DIR__ . '/db-local.php')
    ],
    'params' => require(__DIR__ . '/params-local.php')
];
