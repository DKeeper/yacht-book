<?php
date_default_timezone_set('Europe/Moscow');
// change the following paths if necessary
//$yii=dirname(__FILE__).'/../framework/yii.php';
require(dirname(__FILE__) . '/../framework/YiiBase.php');

class Yii extends YiiBase {
    /**
     * @static
     * @return CWebApplication
     */
    public static function app()
    {
        return parent::app();
    }
}
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//require_once($yii);
$a = Yii::createWebApplication($config);
$a->onBeginRequest = function ($event) {
    $enabledLang = array_keys(Yii::app()->params['geoFieldName']);
    /** @var $app CWebApplication */
    $app = $event->sender;
    if(preg_match('/^\/\w{2}\//',$_SERVER['REQUEST_URI'])){
        $lang = substr($_SERVER['REQUEST_URI'],1,2);
        $_SERVER['REQUEST_URI'] = preg_replace('/^\/\w{2}/','',$_SERVER['REQUEST_URI']);
        $_SERVER['REDIRECT_URL'] = $_SERVER['REQUEST_URI'];
    } else {
        $lang = $app->request->cookies['lang']->value;
    }
    if(isset($lang)){
        if(array_search($lang,$enabledLang)>=0){
            $app->request->cookies['lang'] = new CHttpCookie('lang', $lang, array('expire'=>time()+24*60*60));
            $app->language = $lang;
        }
    }
};
$a->run();
