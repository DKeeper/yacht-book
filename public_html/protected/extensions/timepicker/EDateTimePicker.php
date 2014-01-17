<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 17.01.14
 * @time 9:17
 * Created by JetBrains PhpStorm.
 */
class EDateTimePicker extends CInputWidget
{
    public $config = array();

    public function init(){
        $resPath = Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('timepicker.assets')
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/jquery.timepicker.js'
        );
        Yii::app()->clientScript->registerCssFile(
            $resPath.'/jquery.timepicker.css'
        );
    }

    public function run(){
        list($name,$id) = $this->resolveNameID();

        if(!isset($this->htmlOptions['id'])){
            $this->htmlOptions['id'] = $id;
        }

        if(!isset($this->htmlOptions['name'])){
            $this->htmlOptions['name'] = $name;
        }

        echo CHtml::tag("input",$this->htmlOptions);

        $config = '';
        if(!empty($this->config)){
            $config = CJSON::encode($this->config);
        }
        $script = "
            $('#{$id}').timepicker({$config});
        ";

        Yii::app()->clientScript->registerScript($name."_timepicker",$script,CClientScript::POS_LOAD);
    }
}
