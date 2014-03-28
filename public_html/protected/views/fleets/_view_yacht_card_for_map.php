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
/** @var $photo YachtPhoto[] */
$photo = YachtPhoto::model()->findAllByAttributes(array('yacht_id'=>$fleet->id),'type != :tid',array(':tid'=>7));
?>
<div class="row">
    <div class="fleet col-md-2">
        <?php
        echo CHtml::image(!empty($photo)?$photo[rand(0,count($photo)-1)]->link:'/i/def/fleets.png','',array('class'=>'fleet_img'));
        ?>
    </div>
    <div class="col-md-10">
        Описание
    </div>
</div>