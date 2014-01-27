<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:05
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
$yachtTypeList = YachtType::model()->getModelList();
$furlingList = SailFurling::model()->getModelList();
$sailMaterialList = SailMaterial::model()->getModelList();
$jibTypeList = JibType::model()->getModelList();
?>
<div class="form-group">
    <div class="col-md-12">
        <?php echo $form->labelEx($profile,"name",array("class"=>"control-label col-md-2")); ?>
        <div class="col-md-10">
            <?php echo $form->textField($profile,'name',array('class'=>'form-control')); ?>
            <?php echo $form->error($profile,'name'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>MODEL</h3>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'type_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>YachtType::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "YachtType",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                // параметры, подробнее можно посмотреть на сайте
                // http://jqueryui.com/demos/autocomplete/
                'options'=>array(
                    'minLength'=>0,
                    'delay'=>0,
                    'showAnim'=>'fold',
                    'click'=>'js: function(event, ui) {
                        $(this).val("");
                        $("#YachtType_name").autocomplete( "search","");
                        return false;}',
                    'select' =>'js: function(event, ui) {
                        this.value = ui.item.value;
                        // записываем полученный id в скрытое поле
                        $("#SyProfile_type_id").val(ui.item.id);
                        $("#SyProfile_shipyard_id").val("");
                        $("#SyProfile_model_id").val("");
                        $("#SyProfile__index_id").val("");
                        $("#YachtShipyard_name").val("");
                        $("#YachtModel_name").val("");
                        $("#YachtIndex_name").val("");
                        return false;}',
                    'change' => 'js: function(event, ui) {
                        if(ui.item===null){
                            $("#SyProfile_type_id").val("");
                        }
                        return false;}',
                    'response' => 'js: function( event, ui ) {
                        if(autoFind){
                            var s = ui.content[0];
                            $("#SyProfile_type_id").val(s.id);
                            this.value = s.value;
                            autoFind = false;
                            return false;
                        }}',
                    'open' => 'js: function( event, ui ) {
                        if(hideSearchResult){
                            $(this).autocomplete("close");
                            hideSearchResult = false;
                        }}',
                    'close' => 'js: function( event, ui ) {
                            if($(this).val()===""){
                                $("#SyProfile_type_id").val("");
                                $("#SyProfile_shipyard_id").val("");
                                $("#SyProfile_model_id").val("");
                                $("#SyProfile__index_id").val("");
                                $("#YachtShipyard_name").val("");
                                $("#YachtModel_name").val("");
                                $("#YachtIndex_name").val("");
                        }}',
                ),
                'htmlOptions' => array(
                    'maxlength'=>50,
                    'placeholder'=>$profile->getAttributeLabel("type_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'shipyard_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>YachtShipyard::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    parent_id: $("#SyProfile_type_id").val(),
                    parent_link: "yacht_type_id",
                    parent_model: "yachtType",
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
                        autoFind = true;
                        hideSearchResult = true;
                        $("#YachtType_name").autocomplete( "search",ui.item.parent_name);
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
                        $("#YachtType_name").autocomplete( "search",s.parent_name);
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
                    'placeholder'=>$profile->getAttributeLabel("shipyard_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'model_id');
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
                        hideSearchResult = true;
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
                    'placeholder'=>$profile->getAttributeLabel("model_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'_index_id');
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
                    'placeholder'=>$profile->getAttributeLabel("_index_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'modification_id');
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
                    'placeholder'=>$profile->getAttributeLabel("modification_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>

        <div class="row">
            <div class="input-group">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $profile,
                'attribute' => 'built_date',
                'language' => Yii::app()->language,
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'minDate' => '-13y',
                    'yearRange' => 'c-13:c+10',
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'placeholder' => $profile->getAttributeLabel("built_date"),
                    'class'=>'form-control'
                ),
            ));
            ?>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <?php echo $form->error($profile,'built_date'); ?>
        </div>

        <div class="row">
            <div class="input-group">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $profile,
                'attribute' => 'renovation_date',
                'language' => Yii::app()->language,
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'minDate' => '-13y',
                    'yearRange' => 'c-13:c+10',
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'placeholder' => $profile->getAttributeLabel("renovation_date"),
                    'class'=>'form-control'
                ),
            ));
            ?>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <?php echo $form->error($profile,'renovation_date'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'double_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("double_cabins"))); ?>
            <?php echo $form->error($profile,'double_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'bunk_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("bunk_cabins"))); ?>
            <?php echo $form->error($profile,'bunk_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'twin_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("twin_cabins"))); ?>
            <?php echo $form->error($profile,'twin_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'single_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("single_cabins"))); ?>
            <?php echo $form->error($profile,'single_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'berth_cabin',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("berth_cabin"))); ?>
            <?php echo $form->error($profile,'berth_cabin'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'berth_salon',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("berth_salon"))); ?>
            <?php echo $form->error($profile,'berth_salon'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'crew_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_cabins"))); ?>
            <?php echo $form->error($profile,'crew_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'crew_berth',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_berth"))); ?>
            <?php echo $form->error($profile,'crew_berth'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'WC',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("WC"))); ?>
            <?php echo $form->error($profile,'WC'); ?>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'shower',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("shower"))); ?>
            <?php echo $form->error($profile,'shower'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <h3>SAILS</h3>
        <div class="row">
            <div class="input-group">
                <?php echo $form->textField($profile,'main_sail_area',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("main_sail_area"))); ?>
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>
            <?php echo $form->error($profile,'main_sail_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->checkBox($profile,'main_sail_full_battened'); ?>
            <?php echo $form->labelEx($profile,'main_sail_full_battened'); ?>
            <?php echo $form->error($profile,'main_sail_full_battened'); ?>
        </div>

        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'main_sail_furling_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>SailFurling::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'main_sail_furling_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "SailFurling",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                'htmlOptions' => array(
                    'maxlength'=>50,
                    'placeholder'=>$profile->getAttributeLabel("main_sail_furling_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>

        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'main_sail_material_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>SailMaterial::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'main_sail_material_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "SailMaterial",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                'htmlOptions' => array(
                    'maxlength'=>50,
                    'placeholder'=>$profile->getAttributeLabel("main_sail_material_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>

        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'jib_type_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>JibType::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'jib_type_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "JibType",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                'htmlOptions' => array(
                    'maxlength'=>50,
                    'placeholder'=>$profile->getAttributeLabel("jib_type_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'jib_area'); ?>
            <?php echo $form->textField($profile,'jib_area',array('class'=>'form-control')); ?>
            <?php echo $form->error($profile,'jib_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'jib_automatic'); ?>
            <?php echo $form->textField($profile,'jib_automatic'); ?>
            <?php echo $form->error($profile,'jib_automatic'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'jib_furling_id'); ?>
            <?php echo $form->textField($profile,'jib_furling_id'); ?>
            <?php echo $form->error($profile,'jib_furling_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'jib_material_id'); ?>
            <?php echo $form->textField($profile,'jib_material_id'); ?>
            <?php echo $form->error($profile,'jib_material_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'winches'); ?>
            <?php echo $form->textField($profile,'winches'); ?>
            <?php echo $form->error($profile,'winches'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'el_winches'); ?>
            <?php echo $form->textField($profile,'el_winches'); ?>
            <?php echo $form->error($profile,'el_winches'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'spinnaker'); ?>
            <?php echo $form->textField($profile,'spinnaker'); ?>
            <?php echo $form->error($profile,'spinnaker'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'spinnaker_area'); ?>
            <?php echo $form->textField($profile,'spinnaker_area'); ?>
            <?php echo $form->error($profile,'spinnaker_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'spinnaker_price'); ?>
            <?php echo $form->textField($profile,'spinnaker_price'); ?>
            <?php echo $form->error($profile,'spinnaker_price'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'spinnaker_deposiit'); ?>
            <?php echo $form->textField($profile,'spinnaker_deposiit'); ?>
            <?php echo $form->error($profile,'spinnaker_deposiit'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'gennaker'); ?>
            <?php echo $form->textField($profile,'gennaker'); ?>
            <?php echo $form->error($profile,'gennaker'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'gennaker_area'); ?>
            <?php echo $form->textField($profile,'gennaker_area'); ?>
            <?php echo $form->error($profile,'gennaker_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'gennaker_price'); ?>
            <?php echo $form->textField($profile,'gennaker_price'); ?>
            <?php echo $form->error($profile,'gennaker_price'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'gennaker_deposit'); ?>
            <?php echo $form->textField($profile,'gennaker_deposit'); ?>
            <?php echo $form->error($profile,'gennaker_deposit'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'length_m'); ?>
            <?php echo $form->textField($profile,'length_m'); ?>
            <?php echo $form->error($profile,'length_m'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'beam'); ?>
            <?php echo $form->textField($profile,'beam'); ?>
            <?php echo $form->error($profile,'beam'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'draft'); ?>
            <?php echo $form->textField($profile,'draft'); ?>
            <?php echo $form->error($profile,'draft'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'mast_draught'); ?>
            <?php echo $form->textField($profile,'mast_draught'); ?>
            <?php echo $form->error($profile,'mast_draught'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'displacement'); ?>
            <?php echo $form->textField($profile,'displacement'); ?>
            <?php echo $form->error($profile,'displacement'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'no_of_engine'); ?>
            <?php echo $form->textField($profile,'no_of_engine'); ?>
            <?php echo $form->error($profile,'no_of_engine'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'engine_type_id'); ?>
            <?php echo $form->textField($profile,'engine_type_id'); ?>
            <?php echo $form->error($profile,'engine_type_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'engine_mark_id'); ?>
            <?php echo $form->textField($profile,'engine_mark_id'); ?>
            <?php echo $form->error($profile,'engine_mark_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'engine_power_hp'); ?>
            <?php echo $form->textField($profile,'engine_power_hp'); ?>
            <?php echo $form->error($profile,'engine_power_hp'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'engine_power_kW'); ?>
            <?php echo $form->textField($profile,'engine_power_kW'); ?>
            <?php echo $form->error($profile,'engine_power_kW'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'wheel_type_id'); ?>
            <?php echo $form->textField($profile,'wheel_type_id'); ?>
            <?php echo $form->error($profile,'wheel_type_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'wheel_no'); ?>
            <?php echo $form->textField($profile,'wheel_no'); ?>
            <?php echo $form->error($profile,'wheel_no'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'rudder'); ?>
            <?php echo $form->textField($profile,'rudder'); ?>
            <?php echo $form->error($profile,'rudder'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'folding_propeller'); ?>
            <?php echo $form->textField($profile,'folding_propeller'); ?>
            <?php echo $form->error($profile,'folding_propeller'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'bow_thruster'); ?>
            <?php echo $form->textField($profile,'bow_thruster'); ?>
            <?php echo $form->error($profile,'bow_thruster'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,'auto_pilot'); ?>
            <?php echo $form->textField($profile,'auto_pilot'); ?>
            <?php echo $form->error($profile,'auto_pilot'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <h3>PROPORTIONS</h3>
    </div>
</div>
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
    ));
    ?>
    <div style="display:none;" id="c"></div>