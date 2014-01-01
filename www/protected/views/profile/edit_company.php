<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 01.01.14
 * @time 13:51
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $modelUser User */
/* @var $profileUser Profile */
/* @var $profileCC CCProfile */
/* @var $form UActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
/* @var $transitLogs CcTransitLog[] */
/* @var $orderOptions CcOrderOptions[] */
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
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
                'view'=>'/register/_company_info_step_1',
                'data'=>array('profileCC'=>$profileCC,'form'=>$form),
            ),
            'company_info_2'=>array(
                'title'=>UserModule::t("Bank"),
                'view'=>'/register/_company_info_step_2',
                'data'=>array('profileCC'=>$profileCC,'form'=>$form),
            ),
            'company_info_3'=>array(
                'title'=>UserModule::t("Policy"),
                'view'=>'/register/_company_info_step_3',
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
                'view'=>'/register/_company_info_step_4',
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