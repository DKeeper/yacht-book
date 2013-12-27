<?php
/* @var $this CcorderoptionsController */
/* @var $model CcOrderOptions */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cc_profile_id'); ?>
		<?php echo $form->textField($model,'cc_profile_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_option_id'); ?>
		<?php echo $form->textField($model,'order_option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'obligatory'); ?>
		<?php echo $form->textField($model,'obligatory'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'included'); ?>
		<?php echo $form->textField($model,'included'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->