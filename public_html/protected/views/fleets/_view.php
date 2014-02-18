<?php
/* @var $this FleetsController */
/* @var $data CcFleets */

/** @var $photo YachtPhoto[] */
$photo = YachtPhoto::model()->findAllByAttributes(array('yacht_id'=>$data->id),'type != :tid',array(':tid'=>7));
?>

<div class="row view link_row" data-fleet="<?php echo $data->id; ?>">
    <div class="fleet col-md-2">
        <?php
        echo CHtml::image(!empty($photo)?$photo[rand(0,count($photo)-1)]->link:'/i/def/fleets.png','',array('class'=>'fleet_img'));
        ?>
    </div>
    <div class="col-md-10">

        <b><?php echo CHtml::encode($data->profile->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::encode(!empty($data->profile->name)?$data->profile->name:Yii::t("view","No data")); ?>
        <br />

        <b><?php echo CHtml::encode($data->profile->getAttributeLabel('single_cabins')); ?>:</b>
        <?php echo CHtml::encode(isset($data->profile->single_cabins)?$data->profile->single_cabins:Yii::t("view","No data")); ?>
        <br />

        <b><?php echo CHtml::encode($data->profile->getAttributeLabel('draft')); ?>:</b>
        <?php echo CHtml::encode(isset($data->profile->draft)?$data->profile->draft:Yii::t("view","No data")); ?>
        <br />

        <b><?php echo CHtml::encode($data->profile->getAttributeLabel('displacement')); ?>:</b>
        <?php echo CHtml::encode(isset($data->profile->displacement)?$data->profile->displacement:Yii::t("view","No data")); ?>
        <br />

        <?php if(false) {?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('isActive')); ?>:</b>
        <?php echo CHtml::encode($data->isActive); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('isTrash')); ?>:</b>
        <?php echo CHtml::encode($data->isTrash); ?>
        <br />
        <?php } ?>
    </div>
</div>