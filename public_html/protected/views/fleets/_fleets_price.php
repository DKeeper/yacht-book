<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
/* @var $model CcFleets */
/* @var $priceCurrYear PriceCurrentYear[] */
/* @var $priceNextYear PriceNextYear[] */
?>
<div class="row">
<?php
    echo CHtml::label(Yii::t("model","This year"),'',array('class'=>'add_price_curr_year'));
    foreach($priceCurrYear as $i=>$price){
        $this->renderPartial("_fleets_price_period",array(
            "i"=>$i,
            "form"=>$form,
            "model"=>$price,
        ));
    }
    echo CHtml::tag(
        "button",
        array(
            "class"=>"btn btn-default",
            'onclick'=>'addPriceCurrYear(this);return false;'
        ),
        "<span class='glyphicon glyphicon-plus'></span>"
    );
?>
</div>
<div class="row">
    <?php
    echo CHtml::label(Yii::t("model","Next year"),'',array('class'=>'add_price_next_year'));
    foreach($priceNextYear as $i=>$price){
        $this->renderPartial("_fleets_price_period",array(
            "i"=>$i,
            "form"=>$form,
            "model"=>$price,
        ));
    }
    echo CHtml::tag(
        "button",
        array(
            "class"=>"btn btn-default",
            'onclick'=>'addPriceNextYear(this);return false;'
        ),
        "<span class='glyphicon glyphicon-plus'></span>"
    );
    ?>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'last_cleaning_incl'); ?></span>
                <?php echo CHtml::textField('checkbox_last_cleaning_incl',$profile->getAttributeLabel("last_cleaning_incl"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'race_sail',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_sail"),'title' => $profile->getAttributeLabel("race_sail"))); ?>
            <?php echo $form->error($profile,'race_sail'); ?>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_price_incl'); ?></span>
                <?php echo CHtml::textField('checkbox_race_sail_price_incl',$profile->getAttributeLabel("race_sail_price_incl"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_deposit_obl'); ?></span>
                <?php echo CHtml::textField('checkbox_race_sail_deposit_obl',$profile->getAttributeLabel("race_sail_deposit_obl"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'race_preparation',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_preparation"),'title' => $profile->getAttributeLabel("race_preparation"))); ?>
            <?php echo $form->error($profile,'race_preparation'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit"),'title' => $profile->getAttributeLabel("deposit"))); ?>
            <?php echo $form->error($profile,'deposit'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'last_minute',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("last_minute"),'title' => $profile->getAttributeLabel("last_minute"))); ?>
            <?php echo $form->error($profile,'last_minute'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'last_cleaning_obl'); ?></span>
                <?php echo CHtml::textField('checkbox_last_cleaning_obl',$profile->getAttributeLabel("last_cleaning_obl"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <?php
            echo CHtml::activeHiddenField($profile,'race_sail_material_id');
            $this->widget('autocombobox.JuiAutoComboBox', array(
                'model'=>SailMaterial::model(),   // модель
                'attribute'=>'name',  // атрибут модели
                'parentModel' => $profile,
                'parentAttribute' => 'race_sail_material_id',
                // "источник" данных для выборки
                'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "SailMaterial",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
                'htmlOptions'=>array(
                    'id'=> get_class(SailMaterial::model())."name_2",
                )
            ));
            ?>
        </div>
        <div class="row">
            <div class="input-group">
                <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_price_obl'); ?></span>
                <?php echo CHtml::textField('checkbox_race_sail_price_obl',$profile->getAttributeLabel("race_sail_price_obl"),array('class'=>'form-control','disabled'=>true)); ?>
            </div>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'race_sail_deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_sail_deposit"),'title' => $profile->getAttributeLabel("race_sail_deposit"))); ?>
            <?php echo $form->error($profile,'race_sail_deposit'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'hull_cleaning',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("hull_cleaning"),'title' => $profile->getAttributeLabel("hull_cleaning"))); ?>
            <?php echo $form->error($profile,'hull_cleaning'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'deposit_insurance_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit_insurance_price"),'title' => $profile->getAttributeLabel("deposit_insurance_price"))); ?>
            <?php echo $form->error($profile,'deposit_insurance_price'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'week_before',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("week_before"),'title' => $profile->getAttributeLabel("week_before"))); ?>
            <?php echo $form->error($profile,'week_before'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <?php echo $form->textField($profile,'last_cleaning_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("last_cleaning_price"),'title' => $profile->getAttributeLabel("last_cleaning_price"))); ?>
            <?php echo $form->error($profile,'last_cleaning_price'); ?>
        </div>
        <div class="row" style="height: 34px;">
            &nbsp;
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'race_sail_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_sail_price"),'title' => $profile->getAttributeLabel("race_sail_price"))); ?>
            <?php echo $form->error($profile,'race_sail_price'); ?>
        </div>
        <div class="row" style="height: 34px;">
            &nbsp;
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'crew_license',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_license"),'title' => $profile->getAttributeLabel("crew_license"))); ?>
            <?php echo $form->error($profile,'crew_license'); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($profile,'deposit_insurance_deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit_insurance_deposit"),'title' => $profile->getAttributeLabel("deposit_insurance_deposit"))); ?>
            <?php echo $form->error($profile,'deposit_insurance_deposit'); ?>
        </div>
    </div>
</div>

<div class="row">
    <?php echo $form->labelEx($profile,'IRC_scan'); ?>
    <?php echo $form->textField($profile,'IRC_scan',array('class'=>'form-control','readonly'=>true)); ?>
    <?php
    $this->widget('fileuploader.EFineUploader',
        array(
            'config'=>array(
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array(
                    'enableAuto'=>false,
                    'preventRetryResponseProperty'=>true
                ),
                'chunking'=>array(
                    'enable'=>true,
                    'partSize'=>100
                ),//bytes
                'callbacks'=>array(
                    'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('#SyProfile_IRC_scan').val(response.link);
                            }
                        }",
                    'onError'=>"js:function(id, name, errorReason){
                            $('#SyProfile_IRC_scan').val();
                            alert(errorReason);
                        }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg','png','gif','pdf'),
                    'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                    'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'UploadSyProfileIRCScan',
                'style'=>'margin-top:5px;'
            ),
        )
    );
    ?>
    <?php echo $form->error($profile,'IRC_scan'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($profile,'ORC_scan'); ?>
    <?php echo $form->textField($profile,'ORC_scan',array('class'=>'form-control','readonly'=>true)); ?>
    <?php
    $this->widget('fileuploader.EFineUploader',
        array(
            'config'=>array(
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array(
                    'enableAuto'=>false,
                    'preventRetryResponseProperty'=>true
                ),
                'chunking'=>array(
                    'enable'=>true,
                    'partSize'=>100
                ),//bytes
                'callbacks'=>array(
                    'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('#SyProfile_ORC_scan').val(response.link);
                            }
                        }",
                    'onError'=>"js:function(id, name, errorReason){
                            $('#SyProfile_ORC_scan').val();
                            alert(errorReason);
                        }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg','png','gif','pdf'),
                    'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                    'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'UploadSyProfileORCScan',
                'style'=>'margin-top:5px;'
            ),
        )
    );
    ?>
    <?php echo $form->error($profile,'ORC_scan'); ?>
</div>
<div class="row">
    <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
</div>
<script>
    function addPriceCurrYear(o){
        var n = $(".price_curr_year").last().attr("class");
        if(typeof n === "undefined"){
            n = 0;
        } else {
            n = n.split(" ");
            n = n[2].split("_");
            n = +n[1]+1;
        }
        $(o).after("<img class=aL src=/i/indicator.gif />");
        $.ajax({
            url:'/ajax/getmodelbynum',
            data:{
                i:n,
                model:"PriceCurrentYear",
                view:"/fleets/_fleets_price_period"
            },
            success:function(answer){
                var o =  $(".price_curr_year");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_price_curr_year").after(answer);
                }
                o = $(".price_curr_year");
                o.parent().find(".aL").remove();
                o.find("div:hidden").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addPriceNextYear(o){
        var n = $(".price_next_year").last().attr("class");
        if(typeof n === "undefined"){
            n = 0;
        } else {
            n = n.split(" ");
            n = n[2].split("_");
            n = +n[1]+1;
        }
        $(o).after("<img class=aL src=/i/indicator.gif />");
        $.ajax({
            url:'/ajax/getmodelbynum',
            data:{
                i:n,
                model:"PriceNextYear",
                view:"/fleets/_fleets_price_period"
            },
            success:function(answer){
                var o =  $(".price_next_year");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_price_next_year").after(answer);
                }
                o = $(".price_next_year");
                o.parent().find(".aL").remove();
                o.find("div:hidden").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=true&language=<?php echo Yii::app()->language; ?>"></script>