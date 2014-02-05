<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
/* @var $yachtFoto array */
$statusList = BaseModel::getFilters('status');
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cc-fleets-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'class'=>'fleets_form form-horizontal'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'cc_id'); ?>
    <?php echo $form->hiddenField($model,'profile_id'); ?>

    <?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            Yii::t("model","Details {n}",array('{n}'=>1))=>array(
                'content'=>$this->renderPartial(
                    '_fleets_detail_1',
                    array('profile'=>$profile,'form'=>$form,'yachtFoto'=>$yachtFoto),
                    true
                ),
                'id'=>'tab1'
            ),
            Yii::t("model","Details {n}",array('{n}'=>2))=>array(
                'content'=>$this->renderPartial(
                    '_fleets_detail_2',
                    array('profile'=>$profile,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
            Yii::t("model","Photo")=>array(
                'content'=>$this->renderPartial(
                    '_fleets_photo',
                    array('profile'=>$profile,'form'=>$form,'yachtFoto'=>$yachtFoto),
                    true
                ),
                'id'=>'tab3'
            ),
            Yii::t("model","Price")=>array(
                'content'=>$this->renderPartial(
                    '_fleets_price',
                    array('profile'=>$profile,'form'=>$form),
                    true
                ),
                'id'=>'tab4'
            ),
        ),
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'fleets_tabs',
        ),
    ));
    ?>

    <?php if(Rights::getAuthorizer()->isSuperuser(Yii::app()->user->id)) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'isActive'); ?>
		<?php echo $form->dropDownList($model,'isActive',$statusList); ?>
		<?php echo $form->error($model,'isActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isTrash'); ?>
		<?php echo $form->dropDownList($model,'isTrash',$statusList); ?>
		<?php echo $form->error($model,'isTrash'); ?>
	</div>
    <?php } ?>

	<div class="row buttons">
        <button data-type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save'); ?></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->