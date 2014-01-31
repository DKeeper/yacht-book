<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
?>
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