<?php
/* @var $this YachtmodelController */
/* @var $model YachtModel */
/* @var $form CActiveForm */
$shipyardList = YachtShipyard::model()->getModelList(array('yachtType'=>'name'));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yacht-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note"><?php echo Yii::t('view','Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shipyard_id'); ?>
		<?php echo $form->dropDownList($model,'shipyard_id',$shipyardList); ?>
		<?php echo $form->error($model,'shipyard_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->