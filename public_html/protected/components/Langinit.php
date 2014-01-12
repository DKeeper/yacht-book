<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.01.14
 * @time 19:07
 * Created by JetBrains PhpStorm.
 */
class Langinit
{
    public function getLang ($event) {
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
    }
}
