<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 03.12.13
 * @time 19:04
 * Created by JetBrains PhpStorm.
 */
Yii::import('zii.widgets.jui.CJuiAutoComplete');

class JuiAutoComboBox extends CJuiAutoComplete
{
    public $parentModel;
    public $parentAttribute;

    public function run()
    {
        list($name,$id)=$this->resolveNameID();
        $parentName = CHtml::activeName($this->parentModel,$this->parentAttribute);
        $parentId = CHtml::getIdByName($parentName);

        if(isset($this->parentModel)){
            $baseHtmlOptions = array(
                'placeholder'=>$this->parentModel->getAttributeLabel($this->parentAttribute),
                'class'=>'form-control'
            );
            $this->htmlOptions = array_merge($baseHtmlOptions,$this->htmlOptions);
        }

        if(isset($this->htmlOptions['id']))
            $id=$this->htmlOptions['id'];
        else
            $this->htmlOptions['id']=$id;
        if(isset($this->htmlOptions['name']))
            $name=$this->htmlOptions['name'];

        echo CHtml::openTag("div",array("class"=>"input-group"));
        if($this->hasModel())
            echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
        else
            echo CHtml::textField($name,$this->value,$this->htmlOptions);
        echo CHtml::openTag("span",array("class"=>"input-group-btn"));
        echo CHtml::tag("button",array("class"=>"btn btn-default","onclick"=>"$('#{$id}').autocomplete('search',''); return false;"),"<span class=caret></span>");
        echo CHtml::closeTag("span");
        echo CHtml::closeTag("div");

        $baseOptions = array(
            'minLength'=>0,
            'delay'=>0,
            'showAnim'=>'fold',
            'click'=>'js: function(event, ui) {
                        $(this).val("");
                        $("#'.$id.'").autocomplete( "search","");
                        return false;}',
            'select' =>'js: function(event, ui) {
                        if(typeof ui.item.id !== "undefined"){
                            this.value = ui.item.value;
                            // записываем полученный id в скрытое поле
                            $("#'.$parentId.'").val(ui.item.id);
                        }
                        return false;}',
            'change' => 'js: function(event, ui) {
                        if(ui.item===null){
                            $("#'.$parentId.'").val("");
                        }
                        return false;}',
            'close' => 'js: function( event, ui ) {
                            if($(this).val()===""){
                                $("#'.$parentId.'").val("");
                        }}',
        );

        $this->options = array_merge($baseOptions,$this->options);

        if($this->sourceUrl!==null)
            $this->options['source']=CHtml::normalizeUrl($this->sourceUrl);
        else
            $this->options['source']=$this->source;

        if(isset($this->options['click'])){
            Yii::app()->getClientScript()->registerScript(__CLASS__."#".$id."_click","jQuery('#{$id}').on('click',".CJavaScript::encode($this->options['click']).")");
            unset($this->options['click']);
        }
        $options=CJavaScript::encode($this->options);
        Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"
            jQuery('#{$id}').autocomplete($options);
        ");
    }
}
