<?php
/* @var $this CcorderoptionsController */
/* @var $model CcOrderOptions */
/* @var $form CActiveForm */
$profileList = CcProfile::model()->getModelList("company_name",' - ',array('order'=>'company_name'));
$orderOptionList = OrderOptions::model()->getModelList();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cc-order-options-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note"><?php echo Yii::t('view','Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_profile_id'); ?>
		<?php echo $form->dropDownList($model,'cc_profile_id',$profileList,array("prompt"=>Yii::t("view","Select company"))); ?>
		<?php echo $form->error($model,'cc_profile_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_option_id'); ?>
		<?php echo $form->dropDownList($model,'order_option_id',$orderOptionList,array("prompt"=>Yii::t("view","Select options"))); ?>
		<?php echo $form->error($model,'order_option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'obligatory'); ?>
		<?php echo $form->checkBox($model,'obligatory'); ?>
		<?php echo $form->error($model,'obligatory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'included'); ?>
		<?php echo $form->checkBox($model,'included'); ?>
		<?php echo $form->error($model,'included'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->