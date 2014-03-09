<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 15.02.14
 * @time 15:01
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $modelUser User */
/* @var $profileUser Profile */
/* @var $profileM MProfile */
/* @var $form UActiveForm */
/* @var $save_mode integer */
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
));
    ?>
    <?php
    /** @var $models CActiveRecord[] */
    $models = array(
        $modelUser,
        $profileUser,
        $profileM,
    );

    echo $form->errorSummary($models);
    echo $form->hiddenField($profileM,'save_mode',array('id'=>'save_mode','name'=>'save_mode','value'=>-1));
    $options = array();
    if($save_mode!=-1){
        $options['active'] = $save_mode;
    }
    ?>
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
            UserModule::t("Manager info")=>array(
                'content'=>$this->renderPartial(
                    '/register/_manager_info',
                    array('profileM'=>$profileM,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
        ),
        'options'=>$options,
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'manager_tabs',
        ),
    ));
    ?>
    <div class="row submit">
        <div class="pull-left"><button class="btn btn-default btn_save"><?php echo UserModule::t("Save"); ?></button></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function(){
        $('button[data-type="next"]').tooltip();
        $('button[data-type="next"]').on("click",function(event){
            $("#save_mode").val(+$('#manager_tabs').tabs("option","active")+1);
            $("#profile-form").submit();
        });
        $(".btn_save").on("click",function(event){
            $("#save_mode").val(+$('#manager_tabs').tabs("option","active"));
            $("#profile-form").submit();
        });
    });
</script>