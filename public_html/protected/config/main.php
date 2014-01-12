<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('fancyapps',dirname(__FILE__).'/../extensions/fancyapps');
Yii::setPathOfAlias('autocombobox',dirname(__FILE__).'/../extensions/autocombobox');
Yii::setPathOfAlias('ckeditor',dirname(__FILE__).'/../extensions/ckeditor');
Yii::setPathOfAlias('recaptcha',dirname(__FILE__).'/../extensions/recaptcha');
if(preg_match("/yacht\-book\.local/",$_SERVER['HTTP_HOST'])){
    $db = array(
        'connectionString' => 'mysql:host=localhost;dbname=yacht-book',
        'emulatePrepare' => true,
        'username' => 'yacht-book',
        'password' => '1',
        'charset' => 'utf8',
    );
} else {
    $db = array(
        'connectionString' => 'mysql:host=localhost;dbname=vadimbudni_0',
        'emulatePrepare' => true,
        'username' => 'vadimbudni_0',
        'password' => '0e0fhM41',
        'charset' => 'utf8',
    );
}

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yacht-book',
    'language'=>'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.*.*'),
		),
        'user'=>array(
            'tableUsers'=>'tbl_users',
            'tableProfiles'=>'tbl_profiles',
            'tableProfileFields'=>'tbl_profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/register'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
            'profileUrl' => array('/profile'),
        ),
        'rights'=>array(
            'superuserName'=>'admin', // Name of the role with super user privileges.
            'install'=>false, // Whether to enable installer.
        ),
	),

	// application components
	'components'=>array(
        'user'=>array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'defaultRoles'=>array('Guest'),
            'assignmentTable'=>'rights_auth_assignment',
            'itemChildTable'=>'rights_auth_item_child',
            'itemTable'=>'rights_auth_item',
            'rightsTable'=>'rights_rights',
        ),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>$db,

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, info',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),

			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'dkapenkin@rambler.ru',
		'noReplyEmail'=>'dkapenkin@rambler.ru',
        'recaptchaPublicKey'=>
            preg_match("/yacht\-book\.local/",$_SERVER['HTTP_HOST'])?
                '6LcIsesSAAAAAKrG0XASOw-PgUY9LFu6WQo7HXbH':
                '6LchmOwSAAAAAKtZ5UEgbdLa4-BY8Cjwez0LXFmw',
        'recaptchaPrivateKey'=>
            preg_match("/yacht\-book\.local/",$_SERVER['HTTP_HOST'])?
                '6LcIsesSAAAAAKpfcPKAJmze4tD89dnftUlJ-Nw9':
                '6LchmOwSAAAAALakv1GQRDbdDyBmKwIJXU7zqR7u',
        'geoFieldName' => array(
            'ru' => 1,
            'en' => 2
        ),
	),
);