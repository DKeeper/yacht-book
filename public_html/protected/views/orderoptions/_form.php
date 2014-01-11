<?php
/* @var $this OrderoptionsController */
/* @var $model OrderOptions */
/* @var $form CActiveForm */
/* @var $ajax boolean */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-options-form',
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$model,
            'attribute'=>'description',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
if(isset($ajax) && $ajax){
    $scripts = Yii::app()->clientScript->scripts;
    foreach($scripts as $scriptPosition){
        foreach($scriptPosition as $script){
            echo "<script>".$script."</script>";
        }
    }
}
?>