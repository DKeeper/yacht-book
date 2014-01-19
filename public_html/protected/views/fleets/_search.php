<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
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
		<?php echo $form->label($model,'cc_id'); ?>
		<?php echo $form->textField($model,'cc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profile_id'); ?>
		<?php echo $form->textField($model,'profile_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isActive'); ?>
		<?php echo $form->textField($model,'isActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isTrash'); ?>
		<?php echo $form->textField($model,'isTrash'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->