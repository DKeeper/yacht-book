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
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
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
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'captain_tabs',
        ),
    ));
    ?>
    <div class="row submit">
        <button data-type="submit" class="btn btn-default"><?php echo UserModule::t("Save"); ?></button>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->