<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 10:07
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileM MProfile */
/* @var $form CActiveForm */
?>
<?php echo $form->hiddenField($profileM,'m_id'); ?>
<?php echo $form->hiddenField($profileM,'cc_id'); ?>

<div class="row">
    <?php echo $form->labelEx($profileM,'phone'); ?>
    <?php echo $form->textField($profileM,'phone'); ?>
    <?php echo $form->error($profileM,'phone'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($profileM,'avatar'); ?>
    <?php echo $form->fileField($profileM,'avatar'); ?>
    <?php echo $form->error($profileM,'avatar'); ?>
</div>
<div class="row submit">
    <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
</div>