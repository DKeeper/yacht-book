<?php
/* @var $this YachtindexController */
/* @var $model YachtIndex */
/* @var $form CActiveForm */
/* @var $ajax boolean */
$yachtModelList = YachtModel::model()->getModelList(array('shipyard'=>'name'));
$htmlOptions = array();
if(isset($ajax) && $ajax){
    $htmlOptions = array('disabled'=>true);
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yacht-index-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note"><?php echo Yii::t('view','Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
    <?php echo CHtml::hiddenField('ajaxModel',get_class($model)); ?>
    <?php echo CHtml::hiddenField('ajaxView','_form'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'model_id'); ?>
        <?php echo $form->dropDownList($model,'model_id',$yachtModelList,$htmlOptions); ?>
		<?php echo $form->error($model,'model_id'); ?>
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
<?php
if(isset($ajax) && $ajax){
    $scripts = Yii::app()->clientScript->scripts[4];
    foreach($scripts as $script){
        echo "<script>".$script."</script>";
    }
}
?>