<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 10:04
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $modelUser RegistrationForm */
/* @var $profileUser Profile */
/* @var $profileM MProfile */
/* @var $form UActiveForm */
if(empty($this->pageTitle)){
    $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration manager");
}
if(empty($this->breadcrumbs)){
    $this->breadcrumbs=array(
        UserModule::t("Registration manager"),
    );
}
?>

<h1><?php echo UserModule::t("Registration manager"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
    <?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>
<div class="form">
    <?php $form=$this->beginWidget('UActiveForm', array(
    'id'=>'registration-form',
    'action'=>$this->id=="register"?'manager':'/register/manager',
    'enableAjaxValidation'=>true,
    'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class'=>'form-horizontal'
    ),
));
    ?>
    <?php echo $form->errorSummary(array($modelUser,$profileUser,$profileM)); ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            UserModule::t("User info")=>array(
                'content'=>$this->renderPartial(
                    $this->id=="register"?'_user_info':'/register/_user_info',
                    array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form),
                    true
                ),
                'id'=>'tab1'
            ),
            UserModule::t("Manager info")=>array(
                'content'=>$this->renderPartial(
                    $this->id=="register"?'_manager_info':'/register/_manager_info',
                    array('profileM'=>$profileM,'form'=>$form),
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
            'id'=>'manager_tabs',
        ),
    ));
    ?>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>