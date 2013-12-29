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
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
?>
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
                    field: {yachtType: "name"},
                    sql: false
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
                        field: {shipyard: "name"},
                        sql: false
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
                        field: {model: "name"},
                        sql: false
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
    <div class="row">
        <?php
        echo CHtml::activeLabel($model,'modification_id');
        echo CHtml::activeHiddenField($model,'modification_id');
        $this->widget('autocombobox.JuiAutoComboBox', array(
            'model'=>YachtModification::model(),   // модель
            'attribute'=>'name',  // атрибут модели
            // "источник" данных для выборки
            'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                        term: request.term.split(/,s*/).pop(),
                        parent_id: $("#SyProfile_model_id").val(),
                        parent_link: "model_id",
                        parent_model: "model",
                        modelClass: "YachtModification",
                        field: {model: "name"},
                        sql: false
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
                    $("#YachtModification_name").autocomplete( "search","");
                    return false;
                }',
                'select' =>'js: function(event, ui) {
                    if(!ui.item.id){
                        createAddForm("#c","modification");
                        $(".custom_create").click();
                    } else {
                        this.value = ui.item.value;
                        // записываем полученный id в скрытое поле
                        $("#SyProfile_modification_id").val(ui.item.id);
                        $("#SyProfile_model_id").val(ui.item.parent_id);
                        autoFind = true;
                        hideSearchResult = true;
                        $("#YachtModel_name").autocomplete( "search",ui.item.parent_name);
                    }
                    return false;
                }',
                'change' => 'js: function(event, ui) {
                    if(ui.item===null){
                        $("#SyProfile_modification_id").val("");
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
            'config'=>array(
                'maxWidth'	=> 225,
                'maxHeight'	=> 175,
                'afterClose'=>"function(){jQuery(currentObj).effect('highlight',500);}",
            ),
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