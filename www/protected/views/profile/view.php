<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 14:34
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model User */
/* @var $profile Profile */
/* @var $profileCC CcProfile */
/* @var $profileC CProfile */
/* @var $profileM MProfile */
/* @var $role string */
/* @var $owner boolean */
/* @var $view string */
/* @var $no_load boolean */
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
    UserModule::t("Profile"),
);
if(isset($no_load)){
    echo Yii::t('view','Profile not found');
} else {
    $this->menu=array(
        array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
        array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
        array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
    );
    ?>
<?php
    switch($view){
        case 'C': // Профиль капитана
            $header = ($owner?UserModule::t('Your profile'):UserModule::t('Profile captain: {username}',array('{username}'=>$model->profile->lastname." ".$model->profile->firstname)));
            break;
        case 'CC': // Профиль компании
            $header = ($owner?UserModule::t('Your profile'):UserModule::t('Profile company: {username}',array('{username}'=>$profileCC->company_name)));
            break;
        case 'M': // Профиль менеджера
            $header = ($owner?UserModule::t('Your profile'):UserModule::t('Profile manager: {username}',array('{username}'=>$model->profile->lastname." ".$model->profile->firstname)));
            break;
    }
?>
<h1><?php echo $header; ?></h1>
<?php if(Yii::app()->user->hasFlash('profileMessageSuccess')): ?>
    <?php
        Yii::app()->clientScript->registerScript(
            'myHideEffect',
            '$(".flashinfo").animate({opacity: 1.0}, 3000).fadeOut("slow");',
            CClientScript::POS_READY
        );
    ?>
    <div class="flashinfo">
        <div class="flash success">
            <?php echo Yii::app()->user->getFlash('profileMessageSuccess'); ?>
        </div>
    </div>
    <?php endif; ?>
<?php
    switch($view){
        case 'C': // Профиль капитана

            break;
        case 'CC': // Профиль компании
            $modelUser = new RegistrationForm;
            $profileUser = new Profile;
            $profileUser->regMode = true;
            $profileM = new MProfile();
            $profileM->m_id = -1;
            $profileM->cc_id = -1;
            $this->widget('CTabView', array(
                'tabs'=>array(
                    'company_user'=>array(
                        'title'=>UserModule::t("User info"),
                        'view'=>'_cc_user_info',
                        'data'=>array(),
                    ),
                    'company_info'=>array(
                        'title'=>UserModule::t("Company info"),
                        'view'=>'_cc_company_info',
                        'data'=>array(),
                    ),
                    'company_manager'=>array(
                        'title'=>UserModule::t("Company managers"),
                        'view'=>'_cc_managers',
                        'data'=>array(
                            'model'=>$model,
                            'modelUser'=>$modelUser,
                            'profileUser'=>$profileUser,
                            'profileM'=>$profileM,
                            'profileCC'=>$profileCC,
                            'owner'=>$owner,
                            'role'=>$role
                        ),
                    ),
                ),
                'htmlOptions'=>array(
                    'id'=>'company_profile_tabs',
                ),
            ));
            break;
        case 'M': // Профиль менеджера
            $this->widget('CTabView', array(
                'tabs'=>array(
                    'manager_user'=>array(
                        'title'=>UserModule::t("User info"),
                        'view'=>'_cc_user_info',
                        'data'=>array(),
                    ),
                    'company_info'=>array(
                        'title'=>UserModule::t("Company info"),
                        'view'=>'_cc_company_info',
                        'data'=>array(),
                    )
                ),
                'htmlOptions'=>array(
                    'id'=>'manager_profile_tabs',
                ),
            ));
            break;
    }
}