<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 28.02.14
 * @time 15:06
 * Created by JetBrains PhpStorm.
 */
Yii::import("zii.widgets.jui.CJuiDatePicker");

class EDatePicker extends CJuiDatePicker{

    public $groupStyle = "";

    public $maskOptions = array(
        'mask' => '99.99.9999',
    );

    public function run()
    {
        list($name,$id)=$this->resolveNameID();

        if(isset($this->htmlOptions['id']))
            $id=$this->htmlOptions['id'];
        else
            $this->htmlOptions['id']=$id;
        if(isset($this->htmlOptions['name']))
            $name=$this->htmlOptions['name'];

        echo "<div class='input-group' style='".$this->groupStyle."'>";

        if($this->flat===false)
        {
            $this->widget('CMaskedTextField', array(
                'model' => $this->model,
                'attribute' => $this->attribute,
                'mask' => $this->maskOptions['mask'],
                'htmlOptions' => $this->htmlOptions
                )
            );
        }
        else
        {
            if($this->hasModel())
            {
                echo CHtml::activeHiddenField($this->model,$this->attribute,$this->htmlOptions);
                $attribute=$this->attribute;
                $this->options['defaultDate']=$this->model->$attribute;
            }
            else
            {
                echo CHtml::hiddenField($name,$this->value,$this->htmlOptions);
                $this->options['defaultDate']=$this->value;
            }

            $this->options['altField']='#'.$id;

            $id=$this->htmlOptions['id']=$id.'_container';
            $this->htmlOptions['name']=$name.'_container';

            echo CHtml::tag('div',$this->htmlOptions,'');
        }

        if(isset($this->options['showOn']) && $this->options['showOn'] == 'button'){
            $f = "$(this).prev().click();";
        } else {
            $f = "$(this).prev().focus();";
        }
        echo "<span class='input-group-addon' onclick='{$f}' style='cursor: pointer;'><span class='glyphicon glyphicon-calendar'></span></span></div>";

        $options=CJavaScript::encode($this->options);
        $js = "jQuery('#{$id}').datepicker($options);";

        if($this->language=='en')$this->language='';

        $this->registerScriptFile($this->i18nScriptFile);
        $js = "jQuery('#{$id}').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['{$this->language}'],{$options}));";

        $cs = Yii::app()->getClientScript();

        if(isset($this->defaultOptions))
        {
            $this->registerScriptFile($this->i18nScriptFile);
            $cs->registerScript(__CLASS__,$this->defaultOptions!==null?'jQuery.datepicker.setDefaults('.CJavaScript::encode($this->defaultOptions).');':'');
        }
        $cs->registerScript(__CLASS__.'#'.$id,$js);
    }
}