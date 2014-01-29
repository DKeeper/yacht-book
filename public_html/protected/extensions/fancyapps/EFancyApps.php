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
        Yii::app()->clientScript->registerCssFile(
            $resPath.'/jquery.fancybox.css'
        );
    }

    public function run() {
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
        switch($this->mode){
            case 'inline':
                echo CHtml::link($this->options['label'],$this->options['url'],$this->htmlOptions);
                $jsConfig = CJavaScript::encode($this->config);
                $script = "
                    $('#{$id}').fancybox({$jsConfig});
                ";
                Yii::app()->clientScript->registerScript($this->htmlOptions['class'],$script,CClientScript::POS_LOAD);
                break;
            default:
                break;
        }
    }
}
