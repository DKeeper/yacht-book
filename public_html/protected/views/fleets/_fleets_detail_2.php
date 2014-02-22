<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:08
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
?>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","INSTRUMENTS"); ?></h3>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'GPS',array('onclick'=>'if($(this).is(":checked")){$("#SyProfile_in_cockpit").prop("disabled",false)}else{$("#SyProfile_in_cockpit").prop("disabled",true)}')); ?></span>
                <?php echo CHtml::textField('checkbox_GPS',$profile->getAttributeLabel("GPS"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'in_cockpit',array('disabled'=>true)); ?></span>
                <?php echo CHtml::textField('checkbox_in_cockpit',$profile->getAttributeLabel("in_cockpit"),array('class'=>'form-control','disabled'=>true)); ?>
                <span class="input-group-addon"><span class="glyphicon glyphicon-arrow-up"></span></span>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'wind'); ?></span>
                <?php echo CHtml::textField('checkbox_wind',$profile->getAttributeLabel("wind"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'speed'); ?></span>
                <?php echo CHtml::textField('checkbox_speed',$profile->getAttributeLabel("speed"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'depht'); ?></span>
                <?php echo CHtml::textField('checkbox_depht',$profile->getAttributeLabel("depht"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'compass'); ?></span>
                <?php echo CHtml::textField('checkbox_compass',$profile->getAttributeLabel("compass"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'VHF'); ?></span>
                <?php echo CHtml::textField('checkbox_VHF',$profile->getAttributeLabel("VHF"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'radio'); ?></span>
                <?php echo CHtml::textField('checkbox_radio',$profile->getAttributeLabel("radio"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'inverter'); ?></span>
                <?php echo CHtml::textField('checkbox_inverter',$profile->getAttributeLabel("inverter"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'radar'); ?></span>
                <?php echo CHtml::textField('checkbox_radar',$profile->getAttributeLabel("radar"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'local_charts'); ?></span>
                <?php echo CHtml::textField('checkbox_local_charts',$profile->getAttributeLabel("local_charts"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'local_pilot'); ?></span>
                <?php echo CHtml::textField('checkbox_local_pilot',$profile->getAttributeLabel("local_pilot"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","EXTERIOR"); ?></h3>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'tick_cockpit'); ?></span>
                <?php echo CHtml::textField('checkbox_tick_cockpit',$profile->getAttributeLabel("tick_cockpit"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'tick_deck'); ?></span>
                <?php echo CHtml::textField('checkbox_tick_deck',$profile->getAttributeLabel("tick_deck"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'sprayhood'); ?></span>
                <?php echo CHtml::textField('checkbox_sprayhood',$profile->getAttributeLabel("sprayhood"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'bimini'); ?></span>
                <?php echo CHtml::textField('checkbox_bimini',$profile->getAttributeLabel("bimini"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'hard_top'); ?></span>
                <?php echo CHtml::textField('checkbox_hard_top',$profile->getAttributeLabel("hard_top"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'flybridge'); ?></span>
                <?php echo CHtml::textField('checkbox_flybridge',$profile->getAttributeLabel("flybridge"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'cockpit_table',array('onclick'=>'if($(this).is(":checked")){$("#SyProfile_moveable").prop("disabled",false)}else{$("#SyProfile_moveable").prop("disabled",true)}')); ?></span>
                <?php echo CHtml::textField('checkbox_cockpit_table',$profile->getAttributeLabel("cockpit_table"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'moveable',array('disabled'=>true)); ?></span>
                <?php echo CHtml::textField('checkbox_moveable',$profile->getAttributeLabel("moveable"),array('class'=>'form-control','disabled'=>true)); ?>
                <span class="input-group-addon"><span class="glyphicon glyphicon-arrow-up"></span></span>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'cockpit_speakers'); ?></span>
                <?php echo CHtml::textField('checkbox_cockpit_speakers',$profile->getAttributeLabel("cockpit_speakers"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <h3><?php echo Yii::t("view","TANKS"); ?></h3>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'water_tank'); ?></span>
                <?php echo $form->textField($profile,'water_tank_capacity',array(
                    'class'=>'form-control tank_selector',
                    'placeholder' => $profile->getAttributeLabel("water_tank_capacity"),
                    'title' => $profile->getAttributeLabel("water_tank_capacity")
                )); ?>
                <span class="input-group-addon">l</span>
            </div>
            <?php echo $form->error($profile,'water_tank_capacity'); ?>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'fuel_tank'); ?></span>
                <?php echo $form->textField($profile,'fuel_tank_capacity',array('class'=>'form-control tank_selector','placeholder' => $profile->getAttributeLabel("fuel_tank_capacity"),'title' => $profile->getAttributeLabel("fuel_tank_capacity"))); ?>
                <span class="input-group-addon">l</span>
            </div>
            <?php echo $form->error($profile,'fuel_tank_capacity'); ?>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'grey_tank'); ?></span>
                <?php echo CHtml::textField('checkbox_grey_tank',$profile->getAttributeLabel("grey_tank"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","INTERIOR"); ?></h3>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'hot_water'); ?></span>
                <?php echo CHtml::textField('checkbox_hot_water',$profile->getAttributeLabel("hot_water"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'heater'); ?></span>
                <?php echo CHtml::textField('checkbox_heater',$profile->getAttributeLabel("heater"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'aircon'); ?></span>
                <?php echo CHtml::textField('checkbox_aircon',$profile->getAttributeLabel("aircon"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'water_maker'); ?></span>
                <?php echo CHtml::textField('checkbox_water_maker',$profile->getAttributeLabel("water_maker"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'generator'); ?></span>
                <?php echo CHtml::textField('checkbox_generator',$profile->getAttributeLabel("generator"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>MediaType::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'media_type_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "MediaType",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}'
            ));
            ?>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'aux'); ?></span>
                <?php echo CHtml::textField('checkbox_aux',$profile->getAttributeLabel("aux"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'usb'); ?></span>
                <?php echo CHtml::textField('checkbox_usb',$profile->getAttributeLabel("usb"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'TV'); ?></span>
                <?php echo CHtml::textField('checkbox_TV',$profile->getAttributeLabel("TV"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <h3><?php echo Yii::t("view","KITCHEN"); ?></h3>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'fridge'); ?></span>
                <?php echo CHtml::textField('checkbox_fridge',$profile->getAttributeLabel("fridge"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->textField($profile,'fridge_no',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("fridge_no"),'title' => $profile->getAttributeLabel("fridge_no"))); ?>
            <?php echo $form->error($profile,'fridge_no'); ?>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'freeser'); ?></span>
                <?php echo CHtml::textField('checkbox_freeser',$profile->getAttributeLabel("freeser"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'gas_cooker'); ?></span>
                <?php echo CHtml::textField('checkbox_gas_cooker',$profile->getAttributeLabel("gas_cooker"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'microwave'); ?></span>
                <?php echo CHtml::textField('checkbox_microwave',$profile->getAttributeLabel("microwave"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>

        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'kit_equip'); ?></span>
                <?php echo CHtml::textField('checkbox_kit_equip',$profile->getAttributeLabel("kit_equip"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <?php echo $form->checkBox($profile,'local_skipper'); ?>
        <?php echo $form->labelEx($profile,'local_skipper'); ?>
        <?php echo $form->error($profile,'local_skipper'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'other_details'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profile,
            'attribute'=>'other_details',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profile,'other_details'); ?>
    </div>
<div class="row">
    <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
    <div class="pull-right"><button type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Next"); ?></button></div>
</div>