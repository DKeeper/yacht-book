<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 16.01.14
 * @time 12:17
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $modelUser User */
/* @var $profileUser Profile */
/* @var $profileC CProfile */
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
        $profileC,
    );

    echo $form->errorSummary($models);
    echo $form->hiddenField($profileC,'save_mode',array('id'=>'save_mode','name'=>'save_mode','value'=>-1));
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
            UserModule::t("Captain info")=>array(
                'content'=>$this->renderPartial(
                    '/register/_captain_info',
                    array('profileC'=>$profileC,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
        ),
        'options'=>$options,
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'captain_tabs',
        ),
    ));
    ?>
    <div class="row submit">
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo UserModule::t("Save"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a id="save" href="#"><?php echo UserModule::t("Save"); ?></a></li>
                <li><a id="save_close" href="#"><?php echo UserModule::t("Save and close"); ?></a></li>
            </ul>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function(){
        $('button[data-type="next"]').tooltip();
        $('button[data-type="back"]').on("click",function(event){
            var currTabNum = +$('#captain_tabs').tabs("option","active");
            $('#captain_tabs').tabs("option","active",currTabNum-1);
        });
        $('button[data-type="next"]').on("click",function(event){
            $("#save_mode").val(+$('#captain_tabs').tabs("option","active")+1);
            $("#profile-form").submit();
        });
        $(".dropdown-menu a").on("click",function(event){
            if(this.id==="save_close"){
                $("#save_mode").val(-1);
            } else {
                $("#save_mode").val(+$('#captain_tabs').tabs("option","active"));
            }
            $("#profile-form").submit();
        });
    });
</script>