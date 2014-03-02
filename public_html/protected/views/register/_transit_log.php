<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 27.12.13
 * @time 15:46
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcTransitLog */
/* @var $form CActiveForm */
$geoField = Yii::app()->params['geoFieldName'];
if(isset($geoField[Yii::app()->language])){
    $geoField = 'nazvanie_'.$geoField[Yii::app()->language];
} else {
    $geoField = 'nazvanie_2';
}
$country = '';
if(isset($model->country_id) && !empty($model->country_id)){
    $country = Strana::model()->findByPk($model->country_id)->$geoField;
}
?>
<div class="row transit_log num_<?php echo $i;?>">
    <div class="row">
    <div class="col-md-12">
    <?php
//        $this->widget('autocombobox.JuiAutoComboBox', array(
//            'model'=>Strana::model(),   // модель
//            'attribute'=>'nazvanie_'.Yii::app()->params['geoFieldName'][Yii::app()->language],  // атрибут модели
//            'parentModel' => $model,
//            'parentAttribute' => "[$i]country_id",
//            // "источник" данных для выборки
//            'source' =>'js:function(request, response) {
//                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
//                    term: request.term.split(/,s*/).pop(),
//                    modelClass: "Strana",
//                    fName: "nazvanie_'.Yii::app()->params['geoFieldName'][Yii::app()->language].'",
//                    parent_include: false,
//                    create_include: false,
//                    sql: false
//                }, response);}',
//        ));
    echo $form->labelEx($model,"[$i]country_id");
    echo $form->hiddenField($model,"[$i]country_id");
    $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
        'name'=>'transit_log_country_'.$i,
        'value'=>$country,
        'source'=>"js:function(request, response) {
            $.getJSON('".$this->createUrl('ajax/autocomplete')."', {
                term: request.term.split(/,s*/).pop(),
                modelClass : 'Strana',
                fName: geoFieldName,
                create_include : false,
                sql : false,
            }, response);
        }",
        // additional javascript options for the autocomplete plugin
        'options'=>array(
            'minLength'=>'2',
            'select' =>'js: function(event, ui) {
                // действие по умолчанию, значение текстового поля
                // устанавливается в значение выбранного пункта
                this.value = ui.item.label;
                // устанавливаем значения скрытого поля
                $("#CcTransitLog_'.$i.'_country_id").val(ui.item.id);
                return false;
            }',
            'search' => 'js:function( event, ui ) {
                $("#transit_log_country_'.$i.'").css({backgroundImage:""});
                $("#transit_log_country_'.$i.'").css({backgroundImage:"url(/i/indicator.gif)"});
            }',
            'response' => 'js:function( event, ui ) {
                $("#transit_log_country_'.$i.'").css({backgroundImage:""});
            }',
        ),
        'htmlOptions' => array(
            'class'=>'form-control',
            'style'=>"background-repeat:no-repeat;background-position:right center;",
        ),
    ));
    echo $form->error($model,"[$i]country_id");
    ?>
    </div>
    </div>
    <div class="row">
        <div class="col-md-3">
    <?php
    echo $form->textField($model,"[$i]price",array(
        "class"=>"form-control",
        "placeholder"=>$model->getAttributeLabel("price")
    ));
    echo $form->error($model,"[$i]price");
    ?>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
    <?php
    echo CHtml::openTag("label");
    echo $form->checkBox($model,"[$i]obligatory",array('uncheckValue'=>null));
    echo $model->getAttributeLabel("obligatory");
    echo CHtml::closeTag("label");
    echo $form->error($model,"[$i]obligatory");
    ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
    <?php
    echo CHtml::openTag("label");
    echo $form->checkBox($model,"[$i]included");
    echo $model->getAttributeLabel("included");
    echo CHtml::closeTag("label");
    echo $form->error($model,"[$i]included");
    ?>
            </div>
        </div>
        <div class="col-md-3">
    <?php
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default",
                'onclick'=>'delRow($(this).parent());return false;'
            ),
            Yii::t("view","Delete")."
            <span class='glyphicon glyphicon-minus'></span>
            "
        );
    ?>
        </div>
    </div>
</div>
<script>
    <?php
    if(Yii::app()->request->isAjaxRequest){
        foreach(Yii::app()->clientScript->scripts as $pos){
            foreach($pos as $script){
                echo $script;
            }
        }
    }
    ?>
    $(function(){
        $("#CcTransitLog_<?php echo $i; ?>_included").on("click",function(event){
            if($(this).is(":checked")){
                $("#CcTransitLog_<?php echo $i; ?>_price").val(0).attr("disabled",true);
                $("#CcTransitLog_<?php echo $i; ?>_obligatory").attr("disabled",true);
            } else {
                $("#CcTransitLog_<?php echo $i; ?>_price").attr("disabled",false)
                $("#CcTransitLog_<?php echo $i; ?>_obligatory").attr("disabled",false);
            }
        });
        $("#CcTransitLog_<?php echo $i; ?>_price").on("change",function(){
            if(+$(this).val()>0){
                $("#CcTransitLog_<?php echo $i; ?>_included").attr({"disabled":true,"checked":false});
            } else {
                $("#CcTransitLog_<?php echo $i; ?>_included").attr({"disabled":false,"checked":true});
            }
        });
    });
</script>
