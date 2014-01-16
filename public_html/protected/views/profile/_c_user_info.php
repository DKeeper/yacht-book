<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 16.01.14
 * @time 12:29
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CProfile */
?>
<div class="view_user">
    <div class="avatar pull-left">
        <?php
        echo CHtml::image(isset($model->avatar)?$model->avatar:'/i/def/avatar.png','',array('class'=>'avatar_img'));
        ?>
    </div>
    <div class="info">
        <b><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($model->c->id), array('view', 'id'=>$model->c->id)); ?>
        <br />
        <b><?php echo CHtml::encode(Yii::t('view','Name')); ?>:</b>
        <?php echo CHtml::encode($model->c->profile->lastname." ".$model->c->profile->firstname); ?>
        <br />
        <b><?php echo CHtml::encode($model->c->getAttributeLabel('status')); ?>:</b>
        <?php echo CHtml::encode($model->c->status?Yii::t('view','Active'):Yii::t('view','Not active')); ?>
        <br />
    </div>
</div>