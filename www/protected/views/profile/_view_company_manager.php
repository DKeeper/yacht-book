<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 13.12.13
 * @time 16:07
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $data MProfile */
?>
<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->m->id), array('view', 'id'=>$data->m->id)); ?>
    <br />
    <b><?php echo CHtml::encode(Yii::t('view','Name')); ?>:</b>
    <?php echo CHtml::encode($data->m->profile->lastname." ".$data->m->profile->firstname); ?>
    <br />
    <b><?php echo CHtml::encode($data->m->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->m->status?Yii::t('view','Active'):Yii::t('view','Not active')); ?>
    <br />
</div>