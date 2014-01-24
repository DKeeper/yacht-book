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
?>
    <div class="col-md-12">
        <h3 style="display: inline-block;">NAME</h3>
        <?php echo $form->textField($profile,'name'); ?>
        <?php echo $form->error($profile,'name'); ?>
    </div>
    <div class="col-md-4">
        <h3>MODEL</h3>
    </div>
    <div class="col-md-4">
        <h3>SAILS</h3>
    </div>
    <div class="col-md-4">
        <h3>PROPORTIONS</h3>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'type_id'); ?>
        <?php echo $form->textField($profile,'type_id'); ?>
        <?php echo $form->error($profile,'type_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'shipyard_id'); ?>
        <?php echo $form->textField($profile,'shipyard_id'); ?>
        <?php echo $form->error($profile,'shipyard_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'model_id'); ?>
        <?php echo $form->textField($profile,'model_id'); ?>
        <?php echo $form->error($profile,'model_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'_index_id'); ?>
        <?php echo $form->textField($profile,'_index_id'); ?>
        <?php echo $form->error($profile,'_index_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'modification_id'); ?>
        <?php echo $form->textField($profile,'modification_id'); ?>
        <?php echo $form->error($profile,'modification_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'built_date'); ?>
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
            /*'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),*/
        ));
        ?>
        <?php echo $form->error($profile,'built_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'renovation_date'); ?>
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
            /*'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),*/
        ));
        ?>
        <?php echo $form->error($profile,'renovation_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'double_cabins'); ?>
        <?php echo $form->textField($profile,'double_cabins'); ?>
        <?php echo $form->error($profile,'double_cabins'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'bunk_cabins'); ?>
        <?php echo $form->textField($profile,'bunk_cabins'); ?>
        <?php echo $form->error($profile,'bunk_cabins'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'twin_cabins'); ?>
        <?php echo $form->textField($profile,'twin_cabins'); ?>
        <?php echo $form->error($profile,'twin_cabins'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'single_cabins'); ?>
        <?php echo $form->textField($profile,'single_cabins'); ?>
        <?php echo $form->error($profile,'single_cabins'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'berth_cabin'); ?>
        <?php echo $form->textField($profile,'berth_cabin'); ?>
        <?php echo $form->error($profile,'berth_cabin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'berth_salon'); ?>
        <?php echo $form->textField($profile,'berth_salon'); ?>
        <?php echo $form->error($profile,'berth_salon'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'crew_cabins'); ?>
        <?php echo $form->textField($profile,'crew_cabins'); ?>
        <?php echo $form->error($profile,'crew_cabins'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'crew_berth'); ?>
        <?php echo $form->textField($profile,'crew_berth'); ?>
        <?php echo $form->error($profile,'crew_berth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'WC'); ?>
        <?php echo $form->textField($profile,'WC'); ?>
        <?php echo $form->error($profile,'WC'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'shower'); ?>
        <?php echo $form->textField($profile,'shower'); ?>
        <?php echo $form->error($profile,'shower'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'main_sail_area'); ?>
        <?php echo $form->textField($profile,'main_sail_area'); ?>
        <?php echo $form->error($profile,'main_sail_area'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'main_sail_full_battened'); ?>
        <?php echo $form->textField($profile,'main_sail_full_battened'); ?>
        <?php echo $form->error($profile,'main_sail_full_battened'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'main_sail_furling_id'); ?>
        <?php echo $form->textField($profile,'main_sail_furling_id'); ?>
        <?php echo $form->error($profile,'main_sail_furling_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'main_sail_material_id'); ?>
        <?php echo $form->textField($profile,'main_sail_material_id'); ?>
        <?php echo $form->error($profile,'main_sail_material_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'jib_type_id'); ?>
        <?php echo $form->textField($profile,'jib_type_id'); ?>
        <?php echo $form->error($profile,'jib_type_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'jib_area'); ?>
        <?php echo $form->textField($profile,'jib_area'); ?>
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