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
    public function run()
    {
        list($name,$id)=$this->resolveNameID();

        if(isset($this->htmlOptions['id']))
            $id=$this->htmlOptions['id'];
        else
            $this->htmlOptions['id']=$id;
        if(isset($this->htmlOptions['name']))
            $name=$this->htmlOptions['name'];

        if($this->hasModel())
            echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
        else
            echo CHtml::textField($name,$this->value,$this->htmlOptions);

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
            jQuery('<button type=button>&nbsp;</button>')
			.attr('tabIndex', -1 )
			.attr('title', 'Show All Items')
			.attr('id', 'btn')
			.insertAfter(jQuery('#{$id}'))
			.button({
				icons: {
					primary: 'ui-icon-triangle-1-s'
				},
				text: false
			})
			.removeClass('ui-corner-all')
			.addClass('ui-corner-right ui-button-icon')
			.click(function(event){
			    $('#{$id}').autocomplete('search','');
			    return false;
			});
			jQuery('body').click(function(event){
			    $('#{$id}').autocomplete('close');
			});
        ");
    }
}
