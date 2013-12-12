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
/* @var $role int */
/* @var $owner boolean */
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
<h1><?php echo ($owner?UserModule::t('Your profile'):UserModule::t('Profile: {username}',array('{username}'=>$model->profile->lastname." ".$model->profile->firstname))); ?></h1>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
    <?php endif; ?>
<?php
    switch($role){
        case 1: // Профиль капитана
            echo $owner;
            break;
        case 2: // Профиль компании
            echo $owner;
            break;
        case 3: // Профиль менеджера
            echo $owner;
            break;
    }
}