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
        <?php echo renderRow($profile,'built_date'); ?>
        <?php echo renderRow($profile,'renovation_date'); ?>
        <div class="row" style="height: 34px;">
            &nbsp;
        </div>
        <div class="row">
            <h3><?php echo Yii::t("view","LIVING SPACE"); ?></h3>
        </div>
        <?php echo renderRow($profile,'single_cabins'); ?>
        <?php echo renderRow($profile,'crew_cabins'); ?>
        <?php echo renderRow($profile,'bunk_cabins'); ?>
        <?php echo renderRow($profile,'WC'); ?>
        <?php echo renderRow($profile,'shower'); ?>
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
        echo renderRow($profile,'main_sail_area',array(
            'measure'=>"m<sup>2</sup>",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>=',
                    'compareValue'=>5
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'main_sail_full_battened',array(
            'outtype'=>'checkbox',
        ));
        ?>
        <div class="row">
            <h4><?php echo Yii::t("view","GENOA"); ?></h4>
        </div>
        <?php
        echo renderRow($profile,'jib_area',array(
            'measure'=>"m<sup>2</sup>",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>=',
                    'compareValue'=>5
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'jib_automatic',array(
            'outtype'=>'checkbox',
        ));
        ?>
        <?php echo renderRow($profile,'spinnaker',array(
            'outtype'=>'checkbox',
            'value'=>$profile->spinnaker_area,
            'measure'=>"m<sup>2</sup>",
        ));
        ?>
        <?php echo renderRow($profile,'gennaker',array(
            'outtype'=>'checkbox',
            'value'=>$profile->gennaker_area,
            'measure'=>"m<sup>2</sup>",
        ));
        ?>
        <?php echo renderRow($profile,'winches'); ?>
        <?php echo renderRow($profile,'el_winches'); ?>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","PROPORTIONS"); ?></h3>
        </div>
        <?php echo renderRow($profile,'mast_draught',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'beam',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'draft',array(
            'measure'=>"m",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'displacement',array(
            'measure'=>"t",
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
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
        <?php echo renderRow($profile,'wheel_no',array(
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'rudder',array(
            'validator'=>array(
                'compare',
                'params'=>array(
                    'operator'=>'>',
                    'compareValue'=>0
                )
            )
        ));
        ?>
        <?php echo renderRow($profile,'folding_propeller',array('outtype'=>'checkbox'));?>
        <?php echo renderRow($profile,'bow_thruster',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'auto_pilot',array('outtype'=>'checkbox')); ?>
    </div>
</div>
<div id="more_detail" style="display: none;">
<div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","INSTRUMENTS"); ?></h3>
        </div>
        <?php echo renderRow($profile,'GPS',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'in_cockpit',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'wind',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'speed',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'depht',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'compass',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'VHF',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'radio',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'inverter',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'radar',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'local_charts',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'local_pilot',array('outtype'=>'checkbox')); ?>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h3><?php echo Yii::t("view","EXTERIOR"); ?></h3>
        </div>
        <?php echo renderRow($profile,'tick_cockpit',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'tick_deck',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'sprayhood',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'bimini',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'hard_top',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'flybridge',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'cockpit_table',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'moveable',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'cockpit_speakers',array('outtype'=>'checkbox')); ?>
        <div class="row">
            <h3><?php echo Yii::t("view","TANKS"); ?></h3>
        </div>
        <?php echo renderRow($profile,'water_tank',array(
            'measure'=>"L",
            'outtype'=>'checkbox',
            'value'=>$profile->water_tank_capacity,
        ));
        ?>
        <?php echo renderRow($profile,'fuel_tank',array(
            'measure'=>"L",
            'outtype'=>'checkbox',
            'value'=>$profile->fuel_tank_capacity,
        ));
        ?>
        <?php echo renderRow($profile,'grey_tank',array(
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
        <?php echo renderRow($profile,'hot_water',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'heater',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'aircon',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'water_maker',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'generator',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'media_type_id',array(
            'outtype'=>'checkbox',
            'value'=>isset($profile->media_type_id)?$profile->mediaType->name:'',
        ));?>
        <?php echo renderRow($profile,'aux',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'usb',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'TV',array('outtype'=>'checkbox')); ?>
        <div class="row">
            <h3><?php echo Yii::t("view","KITCHEN"); ?></h3>
        </div>
        <?php echo renderRow($profile,'fridge',array(
            'outtype'=>'checkbox',
            'value'=>$profile->fridge_no,
        ));?>
        <?php echo renderRow($profile,'freeser',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'gas_cooker',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'microwave',array('outtype'=>'checkbox')); ?>
        <?php echo renderRow($profile,'kit_equip',array('outtype'=>'checkbox')); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    <?php echo renderRow($profile,'local_skipper',array('outtype'=>'checkbox')); ?>
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
<?php
function renderRow($model,$attribute='',$options=array()){
    $validate = true;
    if(!isset($options['outtype'])){
        $options['outtype'] = '';
    }
    if(isset($options['validator'])){
        $c = get_class($model);
        /** @var $validateModel BaseModel */
        $validateModel = new $c;
        $validateModel->$attribute = $model->$attribute;
        /** @var $compareValidator CValidator */
        $compareValidator = CValidator::createValidator($options['validator'][0],$validateModel,$attribute,$options['validator']['params']);
        $compareValidator->validate($validateModel,$attribute);
        if($validateModel->hasErrors()){
            $validate = false;
        }
    }
    $_ = "<div class='col-md-1'>";
    if(!isset($model->$attribute)){
        if(!$validate){
            $_ .= "<span class='glyphicon glyphicon-question-sign'></span>";
        } else {
            $_ .= "<span class='glyphicon glyphicon-remove-sign'></span>";
        }
    } else {
        if(!$validate){
            $_ .= "<span class='glyphicon glyphicon-question-sign'></span>";
        } else {
            switch($options['outtype']){
                case 'checkbox':
                    if($model->$attribute){
                        $_ .= "<span class='glyphicon glyphicon-ok text-success'></span>";
                    } else {
                        $_ .= "<span class='glyphicon glyphicon-remove text-danger'></span>";
                    }
                    break;
            }
        }
    }
    $_ .= "</div>
            <div class='col-md-7' style='white-space: nowrap;'>
        ";
    $_ .= Yii::t("view",$attribute);
    $_ .= "</div>
            <div class='col-md-3' style='white-space: nowrap;'>
        ";
    if(isset($model->$attribute)){
        switch($options['outtype']){
            case 'checkbox':
                if(isset($options['value']) && $model->$attribute){
                    $_ .= $options['value'];
                    if(isset($options['measure'])){
                        $_ .= " ".$options['measure'];
                    }
                }
                break;
            default:
                $_ .= $model->$attribute;
                if(isset($options['measure'])){
                    $_ .= " ".$options['measure'];
                }
                break;
        }
    }
    $_ .= "</div>";
    $htmlOptions = array(
        'class'=>'row',
    );
    if(!isset($model->$attribute)){
        $htmlOptions['class'] .= " text-muted";
    }
    if(!$validate){
        $htmlOptions['class'] .= " text-danger";
        $htmlOptions['title'] = $validateModel->getError($attribute);
    }
    return CHtml::tag('div',$htmlOptions,$_);
}
?>