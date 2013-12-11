<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 10.12.13
 * @time 13:45
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $modelUser RegistrationForm */
/* @var $profileUser Profile */
/* @var $form UActiveForm */
?>
    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

    <div class="row">
        <?php echo $form->labelEx($modelUser,'username'); ?>
        <?php echo $form->textField($modelUser,'username'); ?>
        <?php echo $form->error($modelUser,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($modelUser,'password'); ?>
        <?php echo $form->passwordField($modelUser,'password'); ?>
        <?php echo $form->error($modelUser,'password'); ?>
        <p class="hint">
            <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($modelUser,'verifyPassword'); ?>
        <?php echo $form->passwordField($modelUser,'verifyPassword'); ?>
        <?php echo $form->error($modelUser,'verifyPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($modelUser,'email'); ?>
        <?php echo $form->textField($modelUser,'email'); ?>
        <?php echo $form->error($modelUser,'email'); ?>
    </div>

    <?php
    $profileFields=$profileUser->getFields();
    if ($profileFields) {
        foreach($profileFields as $field) {
            ?>
        <div class="row">
            <?php echo $form->labelEx($profileUser,$field->varname); ?>
            <?php
            if ($widgetEdit = $field->widgetEdit($profileUser)) {
                echo $widgetEdit;
            } elseif ($field->range) {
                echo $form->dropDownList($profileUser,$field->varname,Profile::range($field->range));
            } elseif ($field->field_type=="TEXT") {
                echo$form->textArea($profileUser,$field->varname,array('rows'=>6, 'cols'=>50));
            } else {
                echo $form->textField($profileUser,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
            }
            ?>
            <?php echo $form->error($profileUser,$field->varname); ?>
        </div>
        <?php
        }
    }
    ?>
    <?php if (UserModule::doCaptcha('registration')): ?>
<div class="row">
    <?php echo $form->labelEx($modelUser,'verifyCode'); ?>

    <?php $this->widget('CCaptcha'); ?>
    <?php echo $form->textField($modelUser,'verifyCode'); ?>
    <?php echo $form->error($modelUser,'verifyCode'); ?>

    <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
        <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
</div>
<?php endif; ?>

    <div class="row submit">
        <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
    </div>
<script>
    $(function(){
        $("#Profile_firstname").on("change",function(){
            $("#CProfile_name_eng").val($(this).val());
            $("#CProfile_name_rus").val($(this).val());
        });
        $("#Profile_lastname").on("change",function(){
            $("#CProfile_last_name_eng").val($(this).val());
            $("#CProfile_last_name_rus").val($(this).val());
        });
        $("#RegistrationForm_email").on("change",function(){
            $("#CProfile_email").val($(this).val());
        });
    });
</script>