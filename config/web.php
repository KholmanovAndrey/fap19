<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'fap19.ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
            'defaultRoute' => 'order/index'
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'z_nA33fNIjHtqnH6r7eDqDFHiEVJhiee',
            'baseUrl' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'fap19.ru',
                'username' => $params['usernameEmail'],
                'password' => $params['passwordEmail'],
                'port' => '465',
                'encryption' => 'ssl',
            ]
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '',
            'rules' => [
                'product/<id:\d+>' => 'product/view',
                'article/page/<page:\d+>' => 'article/index',
                'article' => 'article/index',
                'article/<id:\d+>/page/<page:\d+>' => 'article/view',
                'article/<id:\d+>' => 'article/view',
                'category/page/<page:\d+>' => 'category/index',
                'category' => 'category/index',
                'search' => 'category/search',
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                'category/<id:\d+>' => 'category/view',
                'cart' => 'cart/index',
                'admin' => 'admin/default/index',
                '<action:\w+>' => 'site/<action>',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
