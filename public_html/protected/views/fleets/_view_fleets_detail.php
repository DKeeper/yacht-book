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
?>
<div class="row">
    <div class="btn-group" data-toggle="buttons">
        <?php
        echo CHtml::label(CHtml::radioButton("detail_view",false,array('value'=>'0')).Yii::t("view","basic"),'',array('class'=>'btn btn-default detail_view active'));
        echo CHtml::label(CHtml::radioButton("detail_view",false,array('value'=>'1')).Yii::t("view","more"),'',array('class'=>'btn btn-default detail_view'));
        ?>
    </div>
</div>
<div class="row fleet-detail">
<div id="base_detail">
    <div class="col-md-4">
        <div class="row" style="height: 34px;">
            &nbsp;
        </div>
        <?php echo $this->renderRow($profile,'built_date'); ?>
        <?php echo $this->renderRow($profile,'renovation_date'); ?>
        <div class="row" style="height: 34px;">
            &nbsp;
        </div>
        <div class="row">
            <h3><?php echo Yii::t("view","LIVING SPACE"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'single_cabins'); ?>
        <?php echo $this->renderRow($profile,'crew_cabins'); ?>
        <?php echo $this->renderRow($profile,'bunk_cabins'); ?>
        <?php echo $this->renderRow($profile,'WC'); ?>
        <?php echo $this->renderRow($profile,'shower'); ?>
        <div class="row photo_prev text-center">
            <?php
            if(!empty($yachtFoto[0]->link)){
                echo "<img src='".$yachtFoto[0]->link."' class='img-thumbnail'>";
            } else {
                echo "<img src='/i/def/fleets.png' class='img-thumbnail' />";
            }
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","SAILS"); ?></h3>
        </div>
        <div class="row">
            <h4><?php echo Yii::t("view","MAIN SAILS"); ?></h4>
        </div>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_main_sail_area','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'main_sail_area',array('class'=>'form-control input-sm','placeholder' => $profile->getAttributeLabel('main_sail_area')));
        $form .= "<span class='input-group-addon'>m<sup>2</sup></span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_main_sail_area').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_main_sail_area','inputID':'SyProfile_main_sail_area','errorID':'SyProfile_main_sail_area_em_','model':'SyProfile','name':'main_sail_area','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_main_sail_area',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'main_sail_area',array(
            'measure'=>"m<sup>2</sup>",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>=',
                    'compareValue'=>5
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php echo $this->renderRow($profile,'main_sail_full_battened',array(
            'outtype'=>'checkbox',
        ));
        ?>
        <div class="row">
            <h4><?php echo Yii::t("view","GENOA"); ?></h4>
        </div>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_jib_area','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'jib_area',array('class'=>'form-control  input-sm','placeholder' => $profile->getAttributeLabel('jib_area')));
        $form .= "<span class='input-group-addon'>m<sup>2</sup></span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_jib_area').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_jib_area','inputID':'SyProfile_jib_area','errorID':'SyProfile_jib_area_em_','model':'SyProfile','name':'jib_area','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_jib_area',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'jib_area',array(
            'measure'=>"m<sup>2</sup>",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>=',
                    'compareValue'=>5
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php echo $this->renderRow($profile,'jib_automatic',array(
            'outtype'=>'checkbox',
        ));
        ?>
        <?php echo $this->renderRow($profile,'spinnaker',array(
            'outtype'=>'checkbox',
            'value'=>$profile->spinnaker_area,
            'measure'=>"m<sup>2</sup>",
        ));
        ?>
        <?php echo $this->renderRow($profile,'gennaker',array(
            'outtype'=>'checkbox',
            'value'=>$profile->gennaker_area,
            'measure'=>"m<sup>2</sup>",
        ));
        ?>
        <?php echo $this->renderRow($profile,'winches'); ?>
        <?php echo $this->renderRow($profile,'el_winches'); ?>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","PROPORTIONS"); ?></h3>
        </div>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_mast_draught','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'mast_draught',array('class'=>'form-control  input-sm','placeholder' => $profile->getAttributeLabel('mast_draught')));
        $form .= "<span class='input-group-addon'>m</span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_mast_draught').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_mast_draught','inputID':'SyProfile_mast_draught','errorID':'SyProfile_mast_draught_em_','model':'SyProfile','name':'mast_draught','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_mast_draught',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'mast_draught',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_beam','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'beam',array('class'=>'form-control  input-sm','placeholder' => $profile->getAttributeLabel('beam')));
        $form .= "<span class='input-group-addon'>m</span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_beam').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_beam','inputID':'SyProfile_beam','errorID':'SyProfile_beam_em_','model':'SyProfile','name':'beam','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_beam',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'beam',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_draft','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'draft',array('class'=>'form-control  input-sm','placeholder' => $profile->getAttributeLabel('draft')));
        $form .= "<span class='input-group-addon'>m</span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_draft').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_draft','inputID':'SyProfile_draft','errorID':'SyProfile_draft_em_','model':'SyProfile','name':'draft','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_draft',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'draft',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_displacement','class'=>'form-horizontal'));
        $form .= "<div class='input-group'>";
        $form .= CHtml::activeTextField($profile,'displacement',array('class'=>'form-control  input-sm','placeholder' => $profile->getAttributeLabel('displacement')));
        $form .= "<span class='input-group-addon'>kg</span></div>";
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_displacement').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_displacement','inputID':'SyProfile_displacement','errorID':'SyProfile_displacement_em_','model':'SyProfile','name':'displacement','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_displacement',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'displacement',array(
            'measure'=>"kg",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <div class="row">
            <h3><?php echo Yii::t("view","CONTROL"); ?></h3>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo Yii::t("view","engine"); ?>
            </div>
            <div class="col-md-8">
                <?php
                echo isset($profile->engine_type_id)?$profile->engineType->name:Yii::t("view","No data");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" style="height: 34px;">
                <?php echo Yii::t("view","mark"); ?>
            </div>
            <div class="col-md-8">
                <?php
                echo isset($profile->engine_mark_id)?$profile->engineMark->name:Yii::t("view","No data");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" style="height: 34px;">
                <?php echo Yii::t("view","HP/kW"); ?>
            </div>
            <div class="col-md-8">
                <?php
                echo isset($profile->engine_power_hp)?$profile->engine_power_hp:Yii::t("view","n/a");
                echo " / ";
                echo isset($profile->engine_power_kW)?$profile->engine_power_kW:Yii::t("view","n/a");
                ?>
            </div>
        </div>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_wheel_no','class'=>'form-horizontal'));
        $form .= CHtml::activeTextField($profile,'wheel_no',array('class'=>'form-control input-sm','placeholder' => $profile->getAttributeLabel('wheel_no')));
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_wheel_no').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_wheel_no','inputID':'SyProfile_wheel_no','errorID':'SyProfile_wheel_no_em_','model':'SyProfile','name':'wheel_no','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_wheel_no',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'wheel_no',array(
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php
        $form = "<div class='form' style='display: none;'><div class='row'>";
        $form .= CHtml::beginForm(Yii::app()->createAbsoluteUrl('syprofile/ajaxupdate',array('id'=>$profile->id)),'post',array('id'=>'sy_profile_rudder','class'=>'form-horizontal'));
        $form .= CHtml::activeTextField($profile,'rudder',array('class'=>'form-control input-sm','placeholder' => $profile->getAttributeLabel('rudder')));
        $form .= CHtml::endForm();
        $form .= '</div></div>';
        $script = "jQuery('#sy_profile_rudder').yiiactiveform({
	        'attributes':[
		        {'id':'SyProfile_rudder','inputID':'SyProfile_rudder','errorID':'SyProfile_rudder_em_','model':'SyProfile','name':'rudder','enableAjaxValidation':true,'validateOnChange':true,'status':1,afterValidateAttribute:changeTitle},
		        {'summary':false}
	        ],
	        'errorCss':'error'
        });";
        Yii::app()->clientScript->registerScript('sy_profile_rudder',$script,CClientScript::POS_LOAD);
        echo $this->renderRow($profile,'rudder',array(
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            ),
            'form'=>$form
        ));
        ?>
        <?php echo $this->renderRow($profile,'folding_propeller',array('outtype'=>'checkbox'));?>
        <?php echo $this->renderRow($profile,'bow_thruster',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'auto_pilot',array('outtype'=>'checkbox')); ?>
    </div>
</div>
<div id="more_detail" style="display: none;">
<div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","INSTRUMENTS"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'GPS',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'in_cockpit',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'wind',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'speed',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'depht',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'compass',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'VHF',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'radio',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'inverter',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'radar',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'local_charts',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'local_pilot',array('outtype'=>'checkbox')); ?>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","EXTERIOR"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'tick_cockpit',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'tick_deck',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'sprayhood',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'bimini',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'hard_top',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'flybridge',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'cockpit_table',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'moveable',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'cockpit_speakers',array('outtype'=>'checkbox')); ?>
        <div class="row">
            <h3><?php echo Yii::t("view","TANKS"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'water_tank',array(
            'measure'=>"L",
            'outtype'=>'checkbox',
            'value'=>$profile->water_tank_capacity,
        ));
        ?>
        <?php echo $this->renderRow($profile,'fuel_tank',array(
            'measure'=>"L",
            'outtype'=>'checkbox',
            'value'=>$profile->fuel_tank_capacity,
        ));
        ?>
        <?php echo $this->renderRow($profile,'grey_tank',array(
            'measure'=>"L",
            'outtype'=>'checkbox',
            'value'=>$profile->grey_tank_capacity,
        ));
        ?>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","INTERIOR"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'hot_water',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'heater',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'aircon',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'water_maker',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'generator',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'media_type_id',array(
            'outtype'=>'checkbox',
            'value'=>isset($profile->media_type_id)?$profile->mediaType->name:'',
        ));?>
        <?php echo $this->renderRow($profile,'aux',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'usb',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'TV',array('outtype'=>'checkbox')); ?>
        <div class="row">
            <h3><?php echo Yii::t("view","KITCHEN"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'fridge',array(
            'outtype'=>'checkbox',
            'value'=>$profile->fridge_no,
        ));?>
        <?php echo $this->renderRow($profile,'freeser',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'gas_cooker',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'microwave',array('outtype'=>'checkbox')); ?>
        <?php echo $this->renderRow($profile,'kit_equip',array('outtype'=>'checkbox')); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    <?php echo $this->renderRow($profile,'local_skipper',array('outtype'=>'checkbox')); ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="row col-md-12">
    <?php
    if(isset($profile->other_details)){
        echo $profile->getAttributeLabel("other_details");
        echo "<br/>";
        echo $profile->other_details;
    }
    ?>
</div>
</div>
</div>
<script>
    $(function(){
        $("div.text-danger").tooltip();
        $(".detail_view").on("click",function(event){
            var v = +$(this).find("input").val();
            if(v){
                $("#base_detail").hide();
                $("#more_detail").show();
            } else {
                $("#more_detail").hide();
                $("#base_detail").show();
            }
        });
    });
</script>