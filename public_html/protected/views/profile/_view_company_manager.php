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
<div class="view_manager">
    <div class="avatar pull-left">
        <?php
        echo CHtml::image(isset($data->avatar)?$data->avatar:'/i/def/avatar.png');
        ?>
    </div>
    <div class="pull-right">
        <button class="btn btn-default remove_manager" data-uid="<?php echo $data->m_id; ?>"><?php echo Yii::t('view','Delete'); ?></button>
        <a class="btn btn-default edit_manager" href="<?php echo Yii::app()->createAbsoluteUrl('profile/edit',array('id'=>$data->m_id)); ?>"><?php echo Yii::t('view','Update'); ?></a>
    </div>
    <div class="info">
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->m->id), array('view', 'id'=>$data->m->id)); ?>
        <br />
        <b><?php echo CHtml::encode(Yii::t('view','Name')); ?>:</b>
        <?php echo CHtml::encode($data->m->profile->lastname." ".$data->m->profile->firstname); ?>
        <br />
        <b><?php echo CHtml::encode(Yii::t('model','Phone')); ?>:</b>
        <?php echo CHtml::encode(isset($data->phone)?$data->phone:Yii::t('view','No data')); ?>
        <br />
        <b><?php echo CHtml::encode($data->m->getAttributeLabel('status')); ?>:</b>
        <?php echo CHtml::encode($data->m->status?Yii::t('view','Active'):Yii::t('view','Not active')); ?>
        <br />
    </div>
</div>
<script>
    $(function(){
        $(".remove_manager").on("click",function(event){
            var $self = $(this);
            $.ajax({
                url:'/ajax/rm',
                data:{uid:$self.data("uid")},
                success:function(answer){
                    if(!answer.success){
                        alert(answer.data);
                    } else {
                        location.reload();
                    }
                },
                type:'GET',
                dataType:'json',
                async:true
            });
        });
    });
</script>