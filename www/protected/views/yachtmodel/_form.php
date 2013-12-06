<?php
/* @var $this YachtmodelController */
/* @var $model YachtModel */
/* @var $form CActiveForm */
/* @var $ajax boolean */
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
    <?php echo CHtml::hiddenField('ajaxModel',get_class($model)); ?>
    <?php echo CHtml::hiddenField('ajaxView','_form'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shipyard_id'); ?>
		<?php echo $form->dropDownList($model,'shipyard_id',$shipyardList); ?>
        <?php //echo $form->hiddenField($model, 'shipyard_id'); ?>
        <?php
//        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//            'model'=>YachtShipyard::model(),   // модель
//            'attribute'=>'name',  // атрибут модели
//            // "источник" данных для выборки
//            'source' =>'js:function(request, response) {
//                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
//                    term: request.term.split(/,s*/).pop(),
//                    modelClass: "YachtShipyard",
//                    field: {yachtType: "name"}
//                }, response);
//            }',
//            // параметры, подробнее можно посмотреть на сайте
//            // http://jqueryui.com/demos/autocomplete/
//            'options'=>array(
//                'minLength'=>'1',
//                'showAnim'=>'fold',
//                'select' =>'js: function(event, ui) {
//                    this.value = ui.item.value;
//                    // записываем полученный id в скрытое поле
//                    $("#YachtModel_shipyard_id").val(ui.item.id);
//                    return false;
//                }',
//                'change' => 'js: function(event, ui) {
//                    if(ui.item===null){
//                        $("#YachtModel_shipyard_id").val("");
//                    }
//                    return false;
//                }',
//
//            ),
//            'htmlOptions' => array(
//                'maxlength'=>50,
//            ),
//        ));
        ?>
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
<?php
if(isset($ajax) && $ajax){
    $scripts = Yii::app()->clientScript->scripts[4];
    foreach($scripts as $script){
        echo "<script>".$script."</script>";
    }
}
?>