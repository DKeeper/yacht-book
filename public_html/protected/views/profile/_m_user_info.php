<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 15.02.14
 * @time 15:18
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model MProfile */
?>
<div class="view_user">
    <div class="avatar pull-left">
        <?php
        echo CHtml::image(isset($model->avatar)?$model->avatar:'/i/def/avatar.png','',array('class'=>'avatar_img'));
        ?>
    </div>
    <div class="info">
        <b><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($model->m->id), array('view', 'id'=>$model->m->id)); ?>
        <br />
        <b><?php echo CHtml::encode(Yii::t('view','Name')); ?>:</b>
        <?php echo CHtml::encode($model->m->profile->lastname." ".$model->m->profile->firstname); ?>
        <br />
        <b><?php echo CHtml::encode($model->m->getAttributeLabel('status')); ?>:</b>
        <?php echo CHtml::encode($model->m->status?Yii::t('view','Active'):Yii::t('view','Not active')); ?>
        <br /><b><?php echo CHtml::encode($model->m->getAttributeLabel('phone')); ?>:</b>
        <?php echo CHtml::encode(!empty($model->phone)?$model->phone:Yii::t("view","No data")); ?>
        <br />
    </div>
</div>