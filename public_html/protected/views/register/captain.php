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
/* @var $validate boolean */
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
<h3 style="color:red;"><?php echo Yii::t("view","You can fill in other data profile after registration, in a private office.<br/>We remind you that without a fully populated part of the functional profile of the site will not be available.")?></h3>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
        'id'=>'registration-form',
        'enableAjaxValidation'=>true,
        'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
        ),
        'htmlOptions' => array(
            'class'=>'form-horizontal'
        ),
    ));
?>
<?php
    /** @var $models CActiveRecord[] */
    $models = array(
        $modelUser,
        $profileUser,
        $profileC,
    );
    echo $form->errorSummary($models);
    $err = false;
    foreach($models as $m){
        $e = $m->getErrors();
        if(!empty($e)){
            $err = true;
            break;
        }
    }
    $options = array();
    if(!$err){
        $options = array(
            //'collapsible'=>true,
            'disabled'=> array(1),
        );
    }
?>
<?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            UserModule::t("User info")=>array(
                'content'=>$this->renderPartial(
                    '_user_info',
                    array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form,'validate'=>$validate),
                    true
                ),
                'id'=>'tab1'
            ),
            /*UserModule::t("Captain info")=>array(
                'content'=>$this->renderPartial(
                    '_captain_info',
                    array('profileC'=>$profileC,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),*/
        ),
        // additional javascript options for the tabs plugin
        'options'=>$options,
        'htmlOptions'=>array(
            'id'=>'captain_tabs',
        ),
    ));
?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function(){
        $('button[data-type="next"]').tooltip();
        $('button[data-type="submit"]').tooltip();
        $('button[data-type="back"]').on("click",function(event){
            var currTabNum = +$('#captain_tabs').tabs("option","active");
            $('#captain_tabs').tabs("option","active",currTabNum-1);
        });
        $('button[data-type="next"]').on("click",function(event){
            event.preventDefault();
            $('#registration-form').data('settings')['submitting'] = true;
            $.fn.yiiactiveform.validate(
                    '#registration-form',
                    function(messages){
                        var hasError = false;
                        $.each($('#registration-form').data('settings')['attributes'], function () {
                            hasError = $.fn.yiiactiveform.updateInput(this, messages, $('#registration-form')) || hasError;
                        });
                        $.fn.yiiactiveform.updateSummary($('#registration-form'), messages);
                        if(!hasError){
                            var currTabNum = +$('#captain_tabs').tabs("option","active");
                            $('#captain_tabs').tabs("enable",currTabNum+1);
                            $('#captain_tabs').tabs("option","active",currTabNum+1);
                        }
                    }
            );
            $('#registration-form').data('settings')['submitting'] = false;
            return false;
        });
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