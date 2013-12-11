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
    $this->widget('CTabView', array(
        'tabs'=>array(
            'tab1'=>array(
                'title'=>UserModule::t("User info"),
                'view'=>'_user_info',
                'data'=>array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form),
            ),
            'tab2'=>array(
                'title'=>UserModule::t("Captain info"),
                'view'=>'_captain_info',
                'data'=>array('profileC'=>$profileC,'form'=>$form),
            ),
        ),
    ));
?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>