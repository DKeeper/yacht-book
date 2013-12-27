<?php
/* @var $this CcorderoptionsController */
/* @var $data CcOrderOptions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cc_profile_id')); ?>:</b>
	<?php echo CHtml::encode($data->ccProfile->company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_option_id')); ?>:</b>
	<?php echo CHtml::encode($data->orderOption->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obligatory')); ?>:</b>
	<?php echo CHtml::encode($data->obligatory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('included')); ?>:</b>
	<?php echo CHtml::encode($data->included); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />


</div>