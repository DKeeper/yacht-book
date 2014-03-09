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
/* @var $yachtFoto array */
?>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","MODEL"); ?></h3>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"type_id",array("class"=>"control-label")); ?>
            <?php
            $name = '';
            if(isset($profile->type_id) && !empty($profile->type_id)){
                $name = YachtType::model()->findByPk($profile->type_id)->name;
            }
            echo CHtml::activeHiddenField($profile,'type_id');
            $model = YachtType::model();
            $model->name=$name;
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>$model,   // модель
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
                    'placeholder'=>$profile->getAttributeLabel("type_id"),
                    'title'=>$profile->getAttributeLabel("type_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"shipyard_id",array("class"=>"control-label")); ?>
            <?php
            $name = '';
            if(isset($profile->shipyard_id) && !empty($profile->shipyard_id)){
                $name = YachtShipyard::model()->findByPk($profile->shipyard_id)->name;
            }
            echo CHtml::activeHiddenField($profile,'shipyard_id');
            $model = YachtShipyard::model();
            $model->name=$name;
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>$model,   // модель
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
                    'placeholder'=>$profile->getAttributeLabel("shipyard_id"),
                    'title'=>$profile->getAttributeLabel("shipyard_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"model_id",array("class"=>"control-label")); ?>
            <?php
            $name = '';
            if(isset($profile->model_id) && !empty($profile->model_id)){
                $name = YachtModel::model()->findByPk($profile->model_id)->name;
            }
            echo CHtml::activeHiddenField($profile,'model_id');
            $model = YachtModel::model();
            $model->name=$name;
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>$model,   // модель
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
                    'placeholder'=>$profile->getAttributeLabel("model_id"),
                    'title'=>$profile->getAttributeLabel("model_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"_index_id",array("class"=>"control-label")); ?>
            <?php
            $name = '';
            if(isset($profile->_index_id) && !empty($profile->_index_id)){
                $name = YachtIndex::model()->findByPk($profile->_index_id)->name;
            }
            echo CHtml::activeHiddenField($profile,'_index_id');
            $model = YachtIndex::model();
            $model->name=$name;
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>$model,   // модель
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
                    'placeholder'=>$profile->getAttributeLabel("_index_id"),
                    'title'=>$profile->getAttributeLabel("_index_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"modification_id",array("class"=>"control-label")); ?>
            <?php
            $name = '';
            if(isset($profile->modification_id) && !empty($profile->modification_id)){
                $name = YachtModification::model()->findByPk($profile->modification_id)->name;
            }
            echo CHtml::activeHiddenField($profile,'modification_id');
            $model = YachtModification::model();
            $model->name=$name;
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>$model,   // модель
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
                    'placeholder'=>$profile->getAttributeLabel("modification_id"),
                    'title'=>$profile->getAttributeLabel("modification_id"),
                    'class'=>'form-control'
                ),
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"built_date",array("class"=>"control-label")); ?>
            <?php
                echo $form->dropDownList($profile,'built_date',BaseModel::getYearRange(),array('class'=>'form-control','prompt' => $profile->getAttributeLabel("built_date"),'title' => $profile->getAttributeLabel("built_date")));
            ?>
            <?php echo $form->error($profile,'built_date'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"renovation_date",array("class"=>"control-label")); ?>
            <?php
                echo $form->dropDownList($profile,'renovation_date',BaseModel::getYearRange(),array('class'=>'form-control','prompt' => $profile->getAttributeLabel("renovation_date"),'title' => $profile->getAttributeLabel("renovation_date")));
            ?>
            <?php echo $form->error($profile,'renovation_date'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"double_cabins",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'double_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("double_cabins"),'title' => $profile->getAttributeLabel("double_cabins"))); ?>
            <?php echo $form->error($profile,'double_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"bunk_cabins",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'bunk_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("bunk_cabins"),'title' => $profile->getAttributeLabel("bunk_cabins"))); ?>
            <?php echo $form->error($profile,'bunk_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"twin_cabins",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'twin_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("twin_cabins"),'title' => $profile->getAttributeLabel("twin_cabins"))); ?>
            <?php echo $form->error($profile,'twin_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"single_cabins",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'single_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("single_cabins"),'title' => $profile->getAttributeLabel("single_cabins"))); ?>
            <?php echo $form->error($profile,'single_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"berth_cabin",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'berth_cabin',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("berth_cabin"),'title' => $profile->getAttributeLabel("berth_cabin"))); ?>
            <?php echo $form->error($profile,'berth_cabin'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"berth_salon",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'berth_salon',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("berth_salon"),'title' => $profile->getAttributeLabel("berth_salon"))); ?>
            <?php echo $form->error($profile,'berth_salon'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"crew_cabins",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'crew_cabins',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_cabins"),'title' => $profile->getAttributeLabel("crew_cabins"))); ?>
            <?php echo $form->error($profile,'crew_cabins'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"crew_berth",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'crew_berth',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_berth"),'title' => $profile->getAttributeLabel("crew_berth"))); ?>
            <?php echo $form->error($profile,'crew_berth'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"WC",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'WC',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("WC"),'title' => $profile->getAttributeLabel("WC"))); ?>
            <?php echo $form->error($profile,'WC'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"shower",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'shower',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("shower"),'title' => $profile->getAttributeLabel("shower"))); ?>
            <?php echo $form->error($profile,'shower'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","SAILS"); ?></h3>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"main_sail_area",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'main_sail_area',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("main_sail_area"),'title' => $profile->getAttributeLabel("main_sail_area"))); ?>
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>
            <?php echo $form->error($profile,'main_sail_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"main_sail_full_battened",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'main_sail_full_battened'); ?></span>
                <?php echo CHtml::textField('checkbox_main_sail_full_battened',$profile->getAttributeLabel("main_sail_full_battened"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"main_sail_furling_id",array("class"=>"control-label")); ?>
            <?php
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
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"main_sail_material_id",array("class"=>"control-label")); ?>
            <?php
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
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"jib_type_id",array("class"=>"control-label")); ?>
            <?php
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
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"jib_area",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'jib_area',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("jib_area"),'title' => $profile->getAttributeLabel("jib_area"))); ?>
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>
            <?php echo $form->error($profile,'jib_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"jib_automatic",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'jib_automatic'); ?></span>
                <?php echo CHtml::textField('checkbox_jib_automatic',$profile->getAttributeLabel("jib_automatic"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"jib_furling_id",array("class"=>"control-label")); ?>
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>JibFurling::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'jib_furling_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "JibFurling",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"jib_material_id",array("class"=>"control-label")); ?>
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>SailMaterial::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'jib_material_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "SailMaterial",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                'htmlOptions'=>array(
                    'id'=> get_class(SailMaterial::model())."name_1",
                )
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"winches",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'winches',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("winches"),'title' => $profile->getAttributeLabel("winches"))); ?>
            <?php echo $form->error($profile,'winches'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"el_winches",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'el_winches',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("el_winches"),'title' => $profile->getAttributeLabel("el_winches"))); ?>
            <?php echo $form->error($profile,'el_winches'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"spinnaker_area",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'spinnaker'); ?></span>
                <?php echo $form->textField($profile,'spinnaker_area',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("spinnaker_area"),'title' => $profile->getAttributeLabel("spinnaker_area"))); ?>
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>
            <?php echo $form->error($profile,'spinnaker_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"spinnaker_price",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'spinnaker_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("spinnaker_price"),'title' => $profile->getAttributeLabel("spinnaker_price"))); ?>
            <?php echo $form->error($profile,'spinnaker_price'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"spinnaker_deposiit",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'spinnaker_deposiit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("spinnaker_deposiit"),'title' => $profile->getAttributeLabel("spinnaker_deposiit"))); ?>
            <?php echo $form->error($profile,'spinnaker_deposiit'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"gennaker_area",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'gennaker'); ?></span>
                <?php echo $form->textField($profile,'gennaker_area',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("gennaker_area"),'title' => $profile->getAttributeLabel("gennaker_area"))); ?>
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>
            <?php echo $form->error($profile,'gennaker_area'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"gennaker_price",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'gennaker_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("gennaker_price"),'title' => $profile->getAttributeLabel("gennaker_price"))); ?>
            <?php echo $form->error($profile,'gennaker_price'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"gennaker_deposit",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'gennaker_deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("gennaker_deposit"),'title' => $profile->getAttributeLabel("gennaker_deposit"))); ?>
            <?php echo $form->error($profile,'gennaker_deposit'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","PROPORTIONS"); ?></h3>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"length_m",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'length_m',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("length_m"),'title' => $profile->getAttributeLabel("length_m"))); ?>
                <span class="input-group-addon">m</span>
            </div>
            <?php echo $form->error($profile,'length_m'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"beam",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'beam',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("beam"),'title' => $profile->getAttributeLabel("beam"))); ?>
                <span class="input-group-addon">m</span>
            </div>
            <?php echo $form->error($profile,'beam'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"draft",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'draft',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("draft"),'title' => $profile->getAttributeLabel("draft"))); ?>
                <span class="input-group-addon">m</span>
            </div>
            <?php echo $form->error($profile,'draft'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"mast_draught",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'mast_draught',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("mast_draught"),'title' => $profile->getAttributeLabel("mast_draught"))); ?>
                <span class="input-group-addon">m</span>
            </div>
            <?php echo $form->error($profile,'mast_draught'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"displacement",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'displacement',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("displacement"),'title' => $profile->getAttributeLabel("displacement"))); ?>
                <span class="input-group-addon">kg</span>
            </div>
            <?php echo $form->error($profile,'displacement'); ?>
        </div>
        <div class="row">
            <h3 style="margin:27px 0 0 0;"><?php echo Yii::t("view","CONTROL"); ?></h3>
        </div>
        <div class="row">
            <?php echo $form->labelEx($profile,"no_of_engine",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'no_of_engine',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("no_of_engine"),'title' => $profile->getAttributeLabel("no_of_engine"))); ?>
            <?php echo $form->error($profile,'no_of_engine'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"engine_type_id",array("class"=>"control-label")); ?>
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>EngineType::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'engine_type_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "EngineType",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}'
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"engine_mark_id",array("class"=>"control-label")); ?>
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>EngineMark::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'engine_mark_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "EngineMark",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}'
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"engine_power_hp",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'engine_power_hp',array('class'=>'form-control','placeholder' => Yii::t("model","Engine power"),'title' => Yii::t("model","Engine power"))); ?>
                <span class="input-group-addon"><?php echo Yii::t("model","HP");?></span>
            </div>
            <?php echo $form->error($profile,'engine_power_hp'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"engine_power_kW",array("class"=>"control-label")); ?>
            <div class="input-group">
                <?php echo $form->textField($profile,'engine_power_kW',array('class'=>'form-control','placeholder' => Yii::t("model","Engine power"),'title' => Yii::t("model","Engine power"))); ?>
                <span class="input-group-addon"><?php echo Yii::t("model","kW");?></span>
            </div>
            <?php echo $form->error($profile,'engine_power_kW'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"wheel_type_id",array("class"=>"control-label")); ?>
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>WheelType::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'wheel_type_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "WheelType",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}'
            ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"wheel_no",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'wheel_no',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("wheel_no"),'title' => $profile->getAttributeLabel("wheel_no"))); ?>
            <?php echo $form->error($profile,'wheel_no'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"rudder",array("class"=>"control-label")); ?>
            <?php echo $form->textField($profile,'rudder',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("rudder"),'title' => $profile->getAttributeLabel("rudder"))); ?>
            <?php echo $form->error($profile,'rudder'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"folding_propeller",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'folding_propeller'); ?></span>
                <?php echo CHtml::textField('checkbox_folding_propeller',$profile->getAttributeLabel("folding_propeller"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"bow_thruster",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'bow_thruster'); ?></span>
                <?php echo CHtml::textField('checkbox_bow_thruster',$profile->getAttributeLabel("bow_thruster"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($profile,"auto_pilot",array("class"=>"control-label")); ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'auto_pilot'); ?></span>
                <?php echo CHtml::textField('checkbox_auto_pilot',$profile->getAttributeLabel("auto_pilot"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 layout_preview">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <?php echo Yii::t("view","layout")?>
            </div>
            <div class="panel-body text-center">
                <?php
                if(!empty($yachtFoto[7][0]->link)){
                    echo "<img src='".$yachtFoto[7][0]->link."' class='img-thumbnail'>";
                } else {
                    echo "<span class='glyphicon glyphicon-picture'></span>";
                }
                ?>
            </div>
            <div class="panel-footer">
                <?php
                $this->widget('fileuploader.EFineUploader',
                    array(
                        'config'=>array(
                            'multiple'=>false,
                            'autoUpload'=>true,
                            'request'=>array(
                                'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                                'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                            ),
                            'retry'=>array(
                                'enableAuto'=>false,
                                'preventRetryResponseProperty'=>true
                            ),
                            'chunking'=>array(
                                'enable'=>true,
                                'partSize'=>100
                            ),//bytes
                            'callbacks'=>array(
                                'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('.qq-upload-list').children('.qq-upload-success').fadeOut(1000,function(){ $(this).remove() });
                                $(this._element).parent().parent().find('.panel-body').empty().append(
                                    '<img src=\"'+response.link+'\" \/>'
                                );
                                $('#YachtPhoto_7_0_link').val(response.link);
                                $('#YachtPhoto_7_0_link').parent().find('span.glyphicon').remove();
                                $('#YachtPhoto_7_0_link').parent().find('li.images').remove();
                                $('#YachtPhoto_7_0_link').parent().append(
                                    '<li class=\"images\"><img src=\"'+response.link+'\" class=\"img-thumbnail\" \/><\/li>'
                                );
                                refreshUploadPreview($('.gallery li'));
                            }
                        }",
                                'onError'=>"js:function(id, name, errorReason){
                            alert(errorReason);
                        }",
                            ),
                            'validation'=>array(
                                'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                                'sizeLimit'=>10*1024*1024,//maximum file size in bytes
//                                'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                            ),
                        ),
                        'htmlOptions'=>array(
                            'id'=>'UploadLayoutPhoto',
                        ),
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="pull-right"><button type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Next"); ?></button></div>
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