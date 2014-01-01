<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 01.01.14
 * @time 14:11
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $modelUser User */
/* @var $profileUser Profile */
		$profileFields=$profileUser->getFields();
		if ($profileFields) {
            foreach($profileFields as $field) {
                ?>
            <div class="row">
                <?php echo $form->labelEx($profileUser,$field->varname);

                if ($widgetEdit = $field->widgetEdit($profileUser)) {
                    echo $widgetEdit;
                } elseif ($field->range) {
                    echo $form->dropDownList($profileUser,$field->varname,Profile::range($field->range));
                } elseif ($field->field_type=="TEXT") {
                    echo $form->textArea($profileUser,$field->varname,array('rows'=>6, 'cols'=>50));
                } else {
                    echo $form->textField($profileUser,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                }
                echo $form->error($profileUser,$field->varname); ?>
            </div>
            <?php
            }
        }
?>
	<div class="row">
        <?php echo $form->labelEx($modelUser,'username'); ?>
        <?php echo $form->textField($modelUser,'username',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($modelUser,'username'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($modelUser,'email'); ?>
        <?php echo $form->textField($modelUser,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($modelUser,'email'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(UserModule::t("Save")); ?>
    </div>