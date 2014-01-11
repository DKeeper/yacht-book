<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 26.07.13
 * @time 1:59
 * Created by JetBrains PhpStorm.
 */
class CKEditor extends CInputWidget
{
    public $config;

    public function init(){
        $resPath = Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('ckeditor.assets')
        );
        Yii::app()->clientScript->registerScriptFile(
            $resPath.'/ckeditor.js'
        );
    }

    public function run(){
        list($name, $id) = $this->resolveNameID();
        if(!isset($this->model)) {
            echo CHtml::textArea($this->name,$this->value,$this->htmlOptions);
        } else {
            echo CHtml::activeTextArea($this->model,$this->attribute,$this->htmlOptions);
        }
        $jsConfig = CJavaScript::encode($this->config);
        $script = "window.{$id}_editor = CKEDITOR.replace('{$id}', {$jsConfig});";
        Yii::app()->clientScript->registerScript($id.'_editor',$script,CClientScript::POS_LOAD);
    }
}
