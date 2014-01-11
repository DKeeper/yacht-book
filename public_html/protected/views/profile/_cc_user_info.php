<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 13.12.13
 * @time 10:23
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
?>
<div class="view_user">
    <div class="avatar pull-left">
        <?php
        echo CHtml::image(isset($model->company_logo)?$model->company_logo:'/i/def/avatar.png');
        ?>
    </div>
    <div class="info">
        <b><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($model->cc->id), array('view', 'id'=>$model->cc->id)); ?>
        <br />
        <b><?php echo CHtml::encode(Yii::t('view','Name')); ?>:</b>
        <?php echo CHtml::encode($model->cc->profile->lastname." ".$model->cc->profile->firstname); ?>
        <br />
        <b><?php echo CHtml::encode($model->cc->getAttributeLabel('status')); ?>:</b>
        <?php echo CHtml::encode($model->cc->status?Yii::t('view','Active'):Yii::t('view','Not active')); ?>
        <br />
    </div>
</div>