<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 09.12.13
 * @time 15:40
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $modelUser RegistrationForm */
/* @var $profileUser Profile */
/* @var $profileC CProfile */
/* @var $form UActiveForm */
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration captain");
$this->breadcrumbs=array(
    UserModule::t("Registration captain"),
);
?>

<h1><?php echo UserModule::t("Registration captain"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
    <?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
        'id'=>'registration-form',
        'enableAjaxValidation'=>true,
        'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
    ));
?>
<?php echo $form->errorSummary(array($modelUser,$profileUser,$profileC)); ?>
<?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            UserModule::t("User info")=>array(
                'content'=>$this->renderPartial(
                    '_user_info',
                    array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form),
                    true
                ),
                'id'=>'tab1'
            ),
            UserModule::t("Captain info")=>array(
                'content'=>$this->renderPartial(
                    '_captain_info',
                    array('profileC'=>$profileC,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
        ),
        // additional javascript options for the tabs plugin
        'options'=>array(
            //'collapsible'=>true,
        ),
        'htmlOptions'=>array(
            'id'=>'captain_tabs',
        ),
    ));
?>
<?php $this->endWidget(); ?>
</div><!-- form -->
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
<?php endif; ?>