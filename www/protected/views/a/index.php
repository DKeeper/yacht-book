<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 03.12.13
 * @time 14:57
 * Created by JetBrains PhpStorm.
 */
/* @var $this AController */
/* @var $model SyProfile */
Yii::app()->clientScript->registerCoreScript("yiiactiveform");
?>
<script type="text/javascript">
    var autoFind = false;
    var hideSearchResult = false;
    function createAddForm(o,type){
        var model, pId, pLink;
        switch (type){
            case 'shipyard':
                model = 'YachtShipyard';
                break;
            case 'model':
                model = 'YachtModel';
                pId = $("#SyProfile_shipyard_id").val();
                pLink = "shipyard_id";
                break;
            case 'index':
                model = 'YachtIndex';
                pId = $("#SyProfile_model_id").val();
                pLink = "model_id";
                break;
        }
        $.ajax({
            url:'/ajax/icreate',
            data:{view:'_form',model:model,pId:pId,pLink:pLink},
            success:function(answer){
                showAjaxForm(o,answer);
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function showAjaxForm(o,answer){
        $(o).empty().append(answer).find("form").on("submit",function(event){
            $.ajax({
                url:'/ajax/icreate',
                data: $(this).serialize(),
                success:function(answer){
                    if(answer==="create done"){
                        $(".fancybox-close").click();
                    } else {
                        showAjaxForm(o,answer);
                    }
                },
                type:'POST',
                dataType:'html',
                async:true
            });
            return false;
        });
    }
</script>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'sy-profile-form',
    )); ?>
    <div class="row">
        <?php
        echo CHtml::activeLabel($model,'shipyard_id');
        echo CHtml::activeHiddenField($model,'shipyard_id');
        $this->widget('autocombobox.JuiAutoComboBox', array(
            'model'=>YachtShipyard::model(),   // модель
            'attribute'=>'name',  // атрибут модели
            // "источник" данных для выборки
            'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "YachtShipyard",
                    field: {yachtType: "name"}
                }, response);
            }',
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'=>array(
                'minLength'=>0,
                'delay'=>0,
                'showAnim'=>'fold',
                'click'=>'js: function(event, ui) {
                    $(this).val("");
                    $("#YachtShipyard_name").autocomplete( "search","");
                    return false;
                }',
                'select' =>'js: function(event, ui) {
                    if(!ui.item.id){
                        createAddForm("#c","shipyard");
                        $(".custom_create").click();
                    } else {
                        this.value = ui.item.value;
                        // записываем полученный id в скрытое поле
                        $("#SyProfile_shipyard_id").val(ui.item.id);
                        $("#SyProfile_model_id").val("");
                        $("#SyProfile__index_id").val("");
                        $("#YachtModel_name").val("");
                        $("#YachtIndex_name").val("");
                    }
                    return false;
                }',
                'change' => 'js: function(event, ui) {
                    if(ui.item===null){
                        $("#SyProfile_shipyard_id").val("");
                    }
                    return false;
                }',
                'response' => 'js: function( event, ui ) {
                    if(autoFind){
                        var s = ui.content[1];
                        $("#SyProfile_shipyard_id").val(s.id);
                        this.value = s.value;
                        autoFind = false;
                        return false;
                    }
                }',
                'open' => 'js: function( event, ui ) {
                    if(hideSearchResult){
                        $(this).autocomplete("close");
                        hideSearchResult = false;
                    }
                }',

            ),
            'htmlOptions' => array(
                'maxlength'=>50,
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php
        echo CHtml::activeLabel($model,'model_id');
        echo CHtml::activeHiddenField($model,'model_id');
        $this->widget('autocombobox.JuiAutoComboBox', array(
            'model'=>YachtModel::model(),   // модель
            'attribute'=>'name',  // атрибут модели
            // "источник" данных для выборки
            'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                        term: request.term.split(/,s*/).pop(),
                        parent_id: $("#SyProfile_shipyard_id").val(),
                        parent_link: "shipyard_id",
                        parent_model: "shipyard",
                        modelClass: "YachtModel",
                        field: {shipyard: "name"}
                    },response);
            }',
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'=>array(
                'minLength'=>0,
                'delay'=>0,
                'showAnim'=>'fold',
                'click'=>'js: function(event, ui) {
                    $(this).val("");
                    $("#YachtModel_name").autocomplete( "search","");
                    return false;
                }',
                'select' =>'js: function(event, ui) {
                    if(!ui.item.id){
                        createAddForm("#c","model");
                        $(".custom_create").click();
                    } else {
                        this.value = ui.item.value;
                        // записываем полученный id в скрытое поле
                        $("#SyProfile_model_id").val(ui.item.id);
                        $("#SyProfile_shipyard_id").val(ui.item.parent_id);
                        $("#SyProfile__index_id").val("");
                        $("#YachtIndex_name").val("");
                        autoFind = true;
                        $("#YachtShipyard_name").autocomplete( "search",ui.item.parent_name);
                    }
                    return false;
                }',
                'change' => 'js: function(event, ui) {
                    if(ui.item===null){
                        $("#SyProfile_model_id").val("");
                    }
                    return false;
                }',
                'response' => 'js: function( event, ui ) {
                    if(autoFind){
                        var s = ui.content[1];
                        $("#SyProfile_model_id").val(s.id);
                        this.value = s.value;
                        $("#YachtShipyard_name").autocomplete( "search",s.parent_name);
                        return false;
                    }
                }',
                'open' => 'js: function( event, ui ) {
                    if(hideSearchResult){
                        $(this).autocomplete("close");
                    }
                }',
            ),
            'htmlOptions' => array(
                'maxlength'=>50,
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php
        echo CHtml::activeLabel($model,'_index_id');
        echo CHtml::activeHiddenField($model,'_index_id');
        $this->widget('autocombobox.JuiAutoComboBox', array(
            'model'=>YachtIndex::model(),   // модель
            'attribute'=>'name',  // атрибут модели
            // "источник" данных для выборки
            'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                        term: request.term.split(/,s*/).pop(),
                        parent_id: $("#SyProfile_model_id").val(),
                        parent_link: "model_id",
                        parent_model: "model",
                        modelClass: "YachtIndex",
                        field: {model: "name"}
                    },response);
            }',
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'=>array(
                'minLength'=>0,
                'delay'=>0,
                'showAnim'=>'fold',
                'click'=>'js: function(event, ui) {
                    $(this).val("");
                    $("#YachtIndex_name").autocomplete( "search","");
                    return false;
                }',
                'select' =>'js: function(event, ui) {
                    if(!ui.item.id){
                        createAddForm("#c","index");
                        $(".custom_create").click();
                    } else {
                        this.value = ui.item.value;
                        // записываем полученный id в скрытое поле
                        $("#SyProfile__index_id").val(ui.item.id);
                        $("#SyProfile_model_id").val(ui.item.parent_id);
                        autoFind = true;
                        hideSearchResult = true;
                        $("#YachtModel_name").autocomplete( "search",ui.item.parent_name);
                    }
                    return false;
                }',
                'change' => 'js: function(event, ui) {
                    if(ui.item===null){
                        $("#SyProfile__index_id").val("");
                    }
                    return false;
                }',

            ),
            'htmlOptions' => array(
                'maxlength'=>50,
            ),
        ));
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save')); ?>
    </div>
    <?php $this->endWidget(); ?>
    <?php
    $this->widget('fancyapps.EFancyApps', array(
            'mode'=>'inline',
            'id'=>'createForm',
            /*'config'=>array(
                'afterClose'=>"function(){alert('!');}",
            ),*/
            'options' => array(
                'url' => '#c',
                'label'=> '',
            ),
            'htmlOptions'=>array('class'=> "custom_create")
        )
    );
    ?>
    <div style="display:none;" id="c"></div>
</div>