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
    <div class="row error">
        <?php echo $form->labelEx($modelUser,'username'); ?>
        <?php echo $form->textField($modelUser,'username'); ?>
        <?php echo $form->error($modelUser,'username'); ?>
    </div>

    <div class="row error">
        <?php echo $form->labelEx($modelUser,'password'); ?>
        <?php echo $form->passwordField($modelUser,'password'); ?>
        <?php echo $form->error($modelUser,'password'); ?>
        <p class="hint">
            <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
        </p>
    </div>

    <div class="row error">
        <?php echo $form->labelEx($modelUser,'verifyPassword'); ?>
        <?php echo $form->passwordField($modelUser,'verifyPassword'); ?>
        <?php echo $form->error($modelUser,'verifyPassword'); ?>
    </div>

    <div class="row error">
        <?php echo $form->labelEx($modelUser,'email'); ?>
        <?php echo $form->textField($modelUser,'email'); ?>
        <?php echo $form->error($modelUser,'email'); ?>
    </div>

    <?php
    $profileFields=$profileUser->getFields();
    if ($profileFields) {
        foreach($profileFields as $field) {
            ?>
        <div class="row error">
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
<div class="row">
    <?php echo $form->labelEx($modelUser,'verifyCode'); ?>
    <?php $this->widget('recaptcha.EReCaptcha',
        array(
            'model'=>$modelUser,
            'attribute'=>'verifyCode',
            'theme'=>'white',
            'language'=>'ru',
            'publicKey'=>Yii::app()->params['recaptchaPublicKey'],
        )
    ); ?>
    <?php echo $form->error($modelUser,'verifyCode'); ?>
</div>
<div class="row">
    <div class="pull-left"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" data-type="submit" class="btn btn-default"><?php echo UserModule::t("Register"); ?></button></div>
    <div class="pull-right"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Forward"); ?></button></div>
</div>
<script>
    $(function(){
        $("span.required").remove();
    });
</script>