<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 28.03.14
 * @time 11:32
 * Created by JetBrains PhpStorm.
 */
/* @var $this AjaxController|FleetsController */
/* @var $fleet CcFleets */
/* @var $company CcProfile */
/* @var $price PriceCurrentYear|PriceNextYear */
$photos = $fleet->yachtPhotos(array('condition'=>'type != :tid','params'=>array(':tid'=>7)));
?>
<div class="row fleet_card">
    <div class="col-md-6">
        <?php
        echo CHtml::image(!empty($photos)?$photos[rand(0,count($photos)-1)]->link:'/i/def/fleets.png','',array('class'=>'fleet_img'));
        ?>
    </div>
    <div class="col-md-6 fleet_detail">
        <div class="row">
            <?php
            echo isset($fleet->profile->model)?$fleet->profile->model->name." ":"";
            echo isset($fleet->profile->index)?$fleet->profile->index->name." - ":"";
            echo "'".(!empty($fleet->profile->name)?$fleet->profile->name:Yii::t("view","No name"))."'";
            ?>
        </div>
        <div class="row">
            <?php echo $fleet->profile->built_date; ?>
        </div>
        <div class="row">
            <?php echo ($fleet->profile->single_cabins + $fleet->profile->double_cabins + $fleet->profile->berth_cabin).Yii::t("view","cabins"); ?>
        </div>
        <div class="row">
            <?php echo $price->date_from." - ".$price->date_to; ?>
        </div>
        <div class="row">
            <?php echo $price->price." ".$company->currency->name; ?>
        </div>
    </div>
</div>