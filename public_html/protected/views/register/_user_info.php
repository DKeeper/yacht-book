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
/* @var $validate boolean */
?>
<div class="row">
    <?php
        if(isset($validate)){
            $class = $modelUser->getError('username')?'error':'success';
        } else {
            $class = 'error';
        }
    ?>
    <div class="col-md-6 <?php echo $class;?>">
        <?php echo $form->labelEx($modelUser,'username'); ?>
        <?php echo $form->textField($modelUser,'username',array('class'=>'form-control')); ?>
        <?php echo $form->error($modelUser,'username'); ?>
    </div>

    <?php
        if(isset($validate)){
            $class = $modelUser->getError('email')?'error':'success';
        } else {
            $class = 'error';
        }
    ?>
    <div class="col-md-6 <?php echo $class;?>">
        <?php echo $form->labelEx($modelUser,'email'); ?>
        <?php echo $form->textField($modelUser,'email',array('class'=>'form-control')); ?>
        <?php echo $form->error($modelUser,'email'); ?>
    </div>
</div>
<div class="row">
    <?php
        if(isset($validate)){
            $class = $modelUser->getError('password')?'error':'success';
        } else {
            $class = 'error';
        }
    ?>
    <div class="col-md-6 <?php echo $class;?>">
        <?php echo $form->labelEx($modelUser,'password'); ?>
        <?php echo $form->passwordField($modelUser,'password',array('class'=>'form-control')); ?>
        <?php echo $form->error($modelUser,'password'); ?>
        <p class="hint">
            <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
        </p>
    </div>

    <?php
        if(isset($validate)){
            $class = $modelUser->getError('verifyPassword')?'error':'success';
        } else {
            $class = 'error';
        }
    ?>
    <div class="col-md-6 <?php echo $class;?>">
        <?php echo $form->labelEx($modelUser,'verifyPassword'); ?>
        <?php echo $form->passwordField($modelUser,'verifyPassword',array('class'=>'form-control')); ?>
        <?php echo $form->error($modelUser,'verifyPassword'); ?>
    </div>
</div>
    <?php
    $profileFields=$profileUser->getFields();
    if ($profileFields) {
        foreach($profileFields as $field) {
            ?>
        <?php
            if(isset($validate)){
                $class = $profileUser->getError($field->varname)?'error':'success';
            } else {
                $class = 'error';
            }
        ?>
        <div class="row col-md-12 <?php echo $class;?>">
            <?php echo $form->labelEx($profileUser,$field->varname); ?>
            <?php
            if ($widgetEdit = $field->widgetEdit($profileUser)) {
                echo $widgetEdit;
            } elseif ($field->range) {
                echo $form->dropDownList($profileUser,$field->varname,Profile::range($field->range),array('class'=>'form-control'));
            } elseif ($field->field_type=="TEXT") {
                echo$form->textArea($profileUser,$field->varname,array('class'=>'form-control','rows'=>6, 'cols'=>50));
            } else {
                echo $form->textField($profileUser,$field->varname,array('class'=>'form-control','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
            }
            ?>
            <?php echo $form->error($profileUser,$field->varname); ?>
        </div>
        <?php
        }
    }
    ?>
<div class="row col-md-12">
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
    <?php if($this->id == "profile") {?>
    <div class="pull-right"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Forward"); ?></button></div>
    <?php } ?>
</div>
<script>
    $(function(){
        $("span.required").remove();
        $("#recaptcha_response_field").attr("placeholder","");
    });
</script>