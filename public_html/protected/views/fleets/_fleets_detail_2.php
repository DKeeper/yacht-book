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
        <?php echo $form->checkBox($profile,'GPS'); ?>
        <?php echo $form->labelEx($profile,'GPS'); ?>
        <?php echo $form->error($profile,'GPS'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'in_cockpit'); ?>
        <?php echo $form->labelEx($profile,'in_cockpit'); ?>
        <?php echo $form->error($profile,'in_cockpit'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'wind'); ?>
        <?php echo $form->labelEx($profile,'wind'); ?>
        <?php echo $form->error($profile,'wind'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'speed'); ?>
        <?php echo $form->labelEx($profile,'speed'); ?>
        <?php echo $form->error($profile,'speed'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'depht'); ?>
        <?php echo $form->labelEx($profile,'depht'); ?>
        <?php echo $form->error($profile,'depht'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'compass'); ?>
        <?php echo $form->labelEx($profile,'compass'); ?>
        <?php echo $form->error($profile,'compass'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'VHF'); ?>
        <?php echo $form->labelEx($profile,'VHF'); ?>
        <?php echo $form->error($profile,'VHF'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'radio'); ?>
        <?php echo $form->labelEx($profile,'radio'); ?>
        <?php echo $form->error($profile,'radio'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'inverter'); ?>
        <?php echo $form->labelEx($profile,'inverter'); ?>
        <?php echo $form->error($profile,'inverter'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'radar'); ?>
        <?php echo $form->labelEx($profile,'radar'); ?>
        <?php echo $form->error($profile,'radar'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'local_charts'); ?>
        <?php echo $form->labelEx($profile,'local_charts'); ?>
        <?php echo $form->error($profile,'local_charts'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'local_pilot'); ?>
        <?php echo $form->labelEx($profile,'local_pilot'); ?>
        <?php echo $form->error($profile,'local_pilot'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'tick_cockpit'); ?>
        <?php echo $form->labelEx($profile,'tick_cockpit'); ?>
        <?php echo $form->error($profile,'tick_cockpit'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'tick_deck'); ?>
        <?php echo $form->labelEx($profile,'tick_deck'); ?>
        <?php echo $form->error($profile,'tick_deck'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'sprayhood'); ?>
        <?php echo $form->labelEx($profile,'sprayhood'); ?>
        <?php echo $form->error($profile,'sprayhood'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'bimini'); ?>
        <?php echo $form->labelEx($profile,'bimini'); ?>
        <?php echo $form->error($profile,'bimini'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'hard_top'); ?>
        <?php echo $form->labelEx($profile,'hard_top'); ?>
        <?php echo $form->error($profile,'hard_top'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'flybridge'); ?>
        <?php echo $form->labelEx($profile,'flybridge'); ?>
        <?php echo $form->error($profile,'flybridge'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'cockpit_table'); ?>
        <?php echo $form->labelEx($profile,'cockpit_table'); ?>
        <?php echo $form->error($profile,'cockpit_table'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'moveable'); ?>
        <?php echo $form->labelEx($profile,'moveable'); ?>
        <?php echo $form->error($profile,'moveable'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'cockpit_speakers'); ?>
        <?php echo $form->labelEx($profile,'cockpit_speakers'); ?>
        <?php echo $form->error($profile,'cockpit_speakers'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'hot_water'); ?>
        <?php echo $form->labelEx($profile,'hot_water'); ?>
        <?php echo $form->error($profile,'hot_water'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'heater'); ?>
        <?php echo $form->labelEx($profile,'heater'); ?>
        <?php echo $form->error($profile,'heater'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'aircon'); ?>
        <?php echo $form->labelEx($profile,'aircon'); ?>
        <?php echo $form->error($profile,'aircon'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'water_maker'); ?>
        <?php echo $form->labelEx($profile,'water_maker'); ?>
        <?php echo $form->error($profile,'water_maker'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'generator'); ?>
        <?php echo $form->labelEx($profile,'generator'); ?>
        <?php echo $form->error($profile,'generator'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'media_type_id'); ?>
        <?php echo $form->textField($profile,'media_type_id'); ?>
        <?php echo $form->error($profile,'media_type_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'aux'); ?>
        <?php echo $form->labelEx($profile,'aux'); ?>
        <?php echo $form->error($profile,'aux'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'usb'); ?>
        <?php echo $form->labelEx($profile,'usb'); ?>
        <?php echo $form->error($profile,'usb'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'TV'); ?>
        <?php echo $form->labelEx($profile,'TV'); ?>
        <?php echo $form->error($profile,'TV'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'water_tank'); ?>
        <?php echo $form->labelEx($profile,'water_tank'); ?>
        <?php echo $form->error($profile,'water_tank'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'fuel_tank'); ?>
        <?php echo $form->labelEx($profile,'fuel_tank'); ?>
        <?php echo $form->error($profile,'fuel_tank'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'grey_tank'); ?>
        <?php echo $form->labelEx($profile,'grey_tank'); ?>
        <?php echo $form->error($profile,'grey_tank'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'fridge'); ?>
        <?php echo $form->labelEx($profile,'fridge'); ?>
        <?php echo $form->error($profile,'fridge'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'fridge_no'); ?>
        <?php echo $form->textField($profile,'fridge_no'); ?>
        <?php echo $form->error($profile,'fridge_no'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'freeser'); ?>
        <?php echo $form->labelEx($profile,'freeser'); ?>
        <?php echo $form->error($profile,'freeser'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'gas_cooker'); ?>
        <?php echo $form->labelEx($profile,'gas_cooker'); ?>
        <?php echo $form->error($profile,'gas_cooker'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'microwave'); ?>
        <?php echo $form->labelEx($profile,'microwave'); ?>
        <?php echo $form->error($profile,'microwave'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'kit_equip'); ?>
        <?php echo $form->labelEx($profile,'kit_equip'); ?>
        <?php echo $form->error($profile,'kit_equip'); ?>
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
        <?php echo $form->labelEx($profile,'latitude'); ?>
        <?php echo $form->textField($profile,'latitude'); ?>
        <?php echo $form->error($profile,'latitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'longitude'); ?>
        <?php echo $form->textField($profile,'longitude'); ?>
        <?php echo $form->error($profile,'longitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'last_cleaning_incl'); ?>
        <?php echo $form->labelEx($profile,'last_cleaning_incl'); ?>
        <?php echo $form->error($profile,'last_cleaning_incl'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'last_cleaning_price'); ?>
        <?php echo $form->textField($profile,'last_cleaning_price'); ?>
        <?php echo $form->error($profile,'last_cleaning_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'last_cleaning_obl'); ?>
        <?php echo $form->labelEx($profile,'last_cleaning_obl'); ?>
        <?php echo $form->error($profile,'last_cleaning_obl'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_sail'); ?>
        <?php echo $form->textField($profile,'race_sail'); ?>
        <?php echo $form->error($profile,'race_sail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_sail_material_id'); ?>
        <?php echo $form->textField($profile,'race_sail_material_id'); ?>
        <?php echo $form->error($profile,'race_sail_material_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_sail_price_incl'); ?>
        <?php echo $form->textField($profile,'race_sail_price_incl'); ?>
        <?php echo $form->error($profile,'race_sail_price_incl'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_sail_price'); ?>
        <?php echo $form->textField($profile,'race_sail_price'); ?>
        <?php echo $form->error($profile,'race_sail_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'race_sail_price_obl'); ?>
        <?php echo $form->labelEx($profile,'race_sail_price_obl'); ?>
        <?php echo $form->error($profile,'race_sail_price_obl'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_sail_deposit'); ?>
        <?php echo $form->textField($profile,'race_sail_deposit'); ?>
        <?php echo $form->error($profile,'race_sail_deposit'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBox($profile,'race_sail_deposit_obl'); ?>
        <?php echo $form->labelEx($profile,'race_sail_deposit_obl'); ?>
        <?php echo $form->error($profile,'race_sail_deposit_obl'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'IRC_scan'); ?>
        <?php echo $form->textArea($profile,'IRC_scan',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($profile,'IRC_scan'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'ORC_scan'); ?>
        <?php echo $form->textArea($profile,'ORC_scan',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($profile,'ORC_scan'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'race_preparation'); ?>
        <?php echo $form->textField($profile,'race_preparation'); ?>
        <?php echo $form->error($profile,'race_preparation'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'hull_cleaning'); ?>
        <?php echo $form->textField($profile,'hull_cleaning'); ?>
        <?php echo $form->error($profile,'hull_cleaning'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profile,'crew_license'); ?>
        <?php echo $form->textField($profile,'crew_license'); ?>
        <?php echo $form->error($profile,'crew_license'); ?>
    </div>