<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => ['@uploads' => 'uploads'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'mailer' => [
                'sender'                => 'proyectoanimas14@gmail.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Bienvenido al proyecto animas',
                'confirmationSubject'   => 'Mensaje de Confirmación',
                'reconfirmationSubject' => 'Cambio de Email',
                'recoverySubject'       => 'Recuperación de Contraseña',
            ],
            'controllerMap' => [
                'profile' => 'app\controllers\ProfileController',
                'settings' => 'app\controllers\SettingsController',
                'admin' => 'app\controllers\user\AdminController',
            ],
            'modelMap' => [
                'Profile' => 'app\models\Profile',
                'User' => 'app\models\User',
                //'SettingsForm' => 'app\models\SettingsForm',
                //'Module' => 'app\models\Module',
            ],

        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'w5cHdQB39K1D9-XoTta2c0bsru_64z0h',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    //'@dektrium/user/views/profile/show' => '@app/views/profile/show',
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /*'user' => [
            //'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,

            'mailer' => [
                'sender'                => 'moonluna189@gmail.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Bienvenido al proyecto animas',
                'confirmationSubject'   => 'Mensaje de Confirmación',
                'reconfirmationSubject' => 'Cambio de Email',
                'recoverySubject'       => 'Recuperación de Contraseña',
            ],
        ],*/
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
                'host' => 'smtp.gmail.com',
                'username' => 'proyectoanimas12@gmail.com',
                'password' => getenv('PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'language' => 'es_ES',
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
