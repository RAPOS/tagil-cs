<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
	'language' => 'ru-RU',
	'sourceLanguage' => 'ru-RU',
    'bootstrap' => ['log'],
	'timeZone' => 'Asia/Yekaterinburg',
    'components' => [
		'image' => [
			'class' => 'yii\image\ImageDriver',
			'driver' => 'GD',  //GD or Imagick
		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ahsd721yuhd7832hdujgh87gf23g8732fghjgf',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\admin\models\BAdmins',
            'enableAutoLogin' => true,
			'loginUrl' => ['/login'],
			'returnUrl' => ['/'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.yandex.ru',
				'username' => 'baron-nt@yandex.ru',
				'password' => 'IaUmxueBXz',
				'port' => '465',
				'encryption' => 'ssl',
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
		'urlManager' => [
			'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api' => 'api']
                ],
				''=>'site/index',
				'<action:\w+>'=>'site/<action>',
				'<action:\w+>/<name:\w+>'=>'site/<action>',
			],
		],
		'general' => [
			'class' => 'app\extensions\general',
		],
    ],
	'modules'=> [
		'admin' => [
			'class' => 'app\modules\admin\Module',
		],
		'gii' => [
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			'ipFilters'=>['127.0.0.1','::1'],
		],
	],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
