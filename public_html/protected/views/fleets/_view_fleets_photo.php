<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 20.02.14
 * @time 9:40
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $yachtFoto YachtPhoto[] */
$images = array();
foreach($yachtFoto as $foto){
    $_ = array(
        'link' => $foto->link,
        'imgOptions' => array(
            'class' => 'img-thumbnail col-md-3'
        )
    );
    array_push($images,$_);
}
$this->widget('fancyapps.EFancyApps', array(
    'id'=>'fleet_gallery',
    'images'=>$images,
    'config'=>array(
        'helpers' => array(
            'thumbs' => array(
                'width' => 100,
				'height' => 100
			),
            'buttons'=>array(),
        ),
    ),
    'htmlOptions'=>array(
        'class'=>'fleet_gallery row'
    )
));