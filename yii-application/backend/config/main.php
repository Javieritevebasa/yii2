<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	'sisgesdev' => [
            'class' => 'backend\modules\sisgesdev\Sisgesdev',
        ],
        'crmItevebasa' => [
            'class' => 'backend\modules\crmItevebasa\crm',
        ],
        'gridview' => [
        'class' => 'kartik\grid\Module',
	        // other module settings
	    ],
	    'gii' => [
	      'class' => 'yii\gii\Module', //adding gii module
	      'allowedIPs' => ['*', '::1']  //allowing ip's 
	    ],
    ],
    
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        
        'formatter' => [
            'dateFormat' => 'dd-MM-yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
            'locale' => 'es-ES', //your language locale
           	'defaultTimeZone' => 'Europe/Madrid', // time zone
       ],
       
	   
       
        'urlManager' => [
            'enablePrettyUrl' => false,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
            	
            ],
        ],
        
		 'telegram' => [
        	'class' => 'aki\telegram\Telegram',
        	'botToken' => '723588706:AAHG1cOMzqGRtKuKL0nLxxno0Tix4J7Zvns',
    	]
        
    ],
    'params' => $params,
];
