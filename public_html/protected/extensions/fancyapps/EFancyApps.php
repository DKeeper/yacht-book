<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 15.10.13
 * @time 7:49
 * Created by JetBrains PhpStorm.
 */
class EFancyApps extends CWidget
{
    public $mode = 'gallery';

    public $images = array();

    public $ajaxOptions = array();

    public $htmlOptions = array();

    public $options = array();

    public $config = array();

    private $eventCallbacks = array(
        'onCancel',
        'beforeLoad',
        'afterLoad',
        'beforeShow',
        'afterShow',
        'beforeChange',
        'beforeClose',
        'afterClose',
    );

    public function init(){
        $resPath = Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('fancyapps.assets')
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/jquery.fancybox.'.(YII_DEBUG?'':'pack.').'js'
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/jquery.mousewheel-3.0.6.pack.js'
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/helpers/jquery.fancybox-buttons.js'
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/helpers/jquery.fancybox-thumbs.js'
        );
        Yii::app()->clientScript->registerCssFile(
            $resPath.'/jquery.fancybox.css'
        );
        Yii::app()->clientScript->registerCssFile(
            $resPath.'/helpers/jquery.fancybox-buttons.css'
        );
        Yii::app()->clientScript->registerCssFile(
            $resPath.'/helpers/jquery.fancybox-thumbs.css'
        );
    }

    public function run() {
        switch($this->mode){
            case 'inline':
                $defaultConfig = array(
                    'maxWidth'	=> 800,
                    'maxHeight'	=> 600,
                    'fitToView'	=> false,
                    'width'		=> '70%',
                    'height'    => '70%',
                    'autoSize'	=> false,
                    'closeClick'	=> false,
                    'openEffect'	=> 'none',
                    'closeEffect'	=> 'none'
                );
                break;
            case 'gallery':
                $defaultConfig = array(
                    'closeClick'	=> false,
                    'openEffect'	=> 'none',
                    'closeEffect'	=> 'none'
                );
                break;
        }

        foreach($this->eventCallbacks as $name){
            if(isset($this->config[$name])){
                $exp = $this->config[$name];
                $this->config[$name] = new CJavaScriptExpression($exp);
            }
        }
        $this->config = array_merge($defaultConfig,$this->config);
        $id = $this->getId();
        if(!isset($this->htmlOptions['id'])){
            $this->htmlOptions['id'] = $id;
        } else {
            $id = $this->htmlOptions['id'];
        }
        $jsConfig = CJavaScript::encode($this->config);
        switch($this->mode){
            case 'inline':
                echo CHtml::link($this->options['label'],$this->options['url'],$this->htmlOptions);
                $script = "
                    $('#{$id}').fancybox({$jsConfig});
                ";
                break;
            case 'gallery':
                $baseHtmlOptions = array(
                    'class' => 'fancybox-thumb',
                    'rel' => 'fancybox-thumb',
                );
                echo CHtml::openTag('div',$this->htmlOptions);
                foreach($this->images as $item){
                    if(isset($item['link'])){
                        if(!isset($item['thumb'])){
                            $item['thumb'] = $item['link'];
                        }
                    }
                    if(isset($item['linkOptions'])){
                        $options = array_merge($baseHtmlOptions,$item['linkOptions']);
                    } else {
                        $options = $baseHtmlOptions;
                    }
                    $img = CHtml::image($item['thumb'],'',$item['imgOptions']);
                    echo CHtml::link($img,$item['link'],$options);
                }
                echo CHtml::closeTag('div');
                $script = "
                    $('.fancybox-thumb').fancybox({$jsConfig});
                ";
                break;
            default:
                $script = "";
                break;
        }
        Yii::app()->clientScript->registerScript($this->htmlOptions['class'],$script,CClientScript::POS_LOAD);
    }
}
