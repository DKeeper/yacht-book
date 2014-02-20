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
    </div>
</div>
<script>
    $(function(){
        $("div.text-danger").tooltip();
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