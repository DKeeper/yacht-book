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
/* @var $profileCC CCProfile */
/* @var $form UActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
/* @var $transitLogs CcTransitLog[] */
/* @var $orderOptions CcOrderOptions[] */
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript("jquery.ui");
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration company");
$this->breadcrumbs=array(
    UserModule::t("Registration company"),
);
?>

<h1><?php echo UserModule::t("Registration company"); ?></h1>

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
<?php echo $form->errorSummary(array($modelUser,$profileUser,$profileCC)); ?>
<?php
    $this->widget('CTabView', array(
        'tabs'=>array(
            'user_info'=>array(
                'title'=>UserModule::t("User info"),
                'view'=>'_user_info',
                'data'=>array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form),
            ),
            'company_info_1'=>array(
                'title'=>UserModule::t("Company info"),
                'view'=>'_company_info_step_1',
                'data'=>array('profileCC'=>$profileCC,'form'=>$form),
            ),
            'company_info_2'=>array(
                'title'=>UserModule::t("Bank"),
                'view'=>'_company_info_step_2',
                'data'=>array('profileCC'=>$profileCC,'form'=>$form),
            ),
            'company_info_3'=>array(
                'title'=>UserModule::t("Policy"),
                'view'=>'_company_info_step_3',
                'data'=>array(
                    'profileCC'=>$profileCC,
                    'form'=>$form,
                    'paymentsPeriods'=>$paymentsPeriods,
                    'cancelPeriods'=>$cancelPeriods,
                    'longPeriods'=>$longPeriods,
                    'earlyPeriods'=>$earlyPeriods,
                ),
            ),
            'company_info_4'=>array(
                'title'=>UserModule::t("Prices"),
                'view'=>'_company_info_step_4',
                'data'=>array(
                    'profileCC'=>$profileCC,
                    'form'=>$form,
                    'transitLogs'=>$transitLogs,
                    'orderOptions'=>$orderOptions,
                ),
            ),
        ),
        'htmlOptions'=>array(
            'id'=>'company_tabs',
        ),
    ));
    ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>