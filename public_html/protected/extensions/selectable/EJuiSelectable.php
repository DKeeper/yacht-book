<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.01.14
 * @time 10:33
 * Created by JetBrains PhpStorm.
 */
Yii::import('zii.widgets.jui.CJuiSelectable');

class EJuiSelectable extends CJuiSelectable
{
    public $selected = array();

    /** @var CActiveRecord */
    public $model;

    public $attribute = '';

    public $modelData = array();

    public $hiddenHtmlOptions = array();

    public $childrenTag = "li";

    public function run()
    {
        $id=$this->getId();
        if(isset($this->htmlOptions['id']))
            $id=$this->htmlOptions['id'];
        else
            $this->htmlOptions['id']=$id;

        $options=CJavaScript::encode($this->options);

        if(isset($this->model) && isset($this->model[$this->attribute])){
            $hiddenName = CHtml::activeName($this->model,$this->attribute);
            $hiddenId = CHtml::getIdByName($hiddenName);
            $this->hiddenHtmlOptions['hidden'] = true;
            echo CHtml::activeDropDownList(
                $this->model,
                $this->attribute,
                $this->modelData,
                $this->hiddenHtmlOptions
            );
        }

        if(empty($this->modelData)){
            echo Yii::t("view","No results");
        } else {
            Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"jQuery('#{$id}').selectable({$options});");
            echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
            if(isset($this->items['data'])){
                foreach($this->items['data'] as $id=>$data){
                    $htmlOptions = array_merge($this->items['htmlOptions'],array('id'=>$id));
                    if(array_key_exists($id,$this->hiddenHtmlOptions['options'])){
                        if(!isset($htmlOptions['class'])){
                            $htmlOptions['class'] = "ui-selected";
                        } else {
                            $htmlOptions['class'] .= " ui-selected";
                        }
                    }
                    echo CHtml::tag($this->childrenTag,$htmlOptions,$data);
                }
            } else {
                foreach($this->items as $id=>$data){
                    echo strtr($this->itemTemplate,array('{id}'=>$id,'{content}'=>$data))."\n";
                }
            }
            echo CHtml::closeTag($this->tagName);
        }
    }
}
