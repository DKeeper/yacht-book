<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
/* @var $yachtFoto array */
/* @var $priceCurrYear PriceCurrentYear[] */
/* @var $priceNextYear PriceNextYear[] */
/* @var $save_mode integer */
$statusList = BaseModel::getFilters('status');
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript('maskedinput');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cc-fleets-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'class'=>'fleets_form form-horizontal'
    ),
)); ?>

	<?php
    echo $form->errorSummary($model);
    echo $form->hiddenField($profile,'save_mode',array('id'=>'save_mode','name'=>'save_mode','value'=>-1));
    $options = array();
    if($save_mode!=-1){
        $options['active'] = $save_mode;
    }

    ?>
    <?php echo $form->hiddenField($model,'cc_id'); ?>
    <?php echo $form->hiddenField($model,'profile_id'); ?>
    <div class="form-group">
        <div class="col-md-12">
            <?php echo $form->labelEx($profile,"name",array("class"=>"control-label col-md-2")); ?>
            <div class="col-md-10">
                <?php echo $form->textField($profile,'name',array('class'=>'form-control')); ?>
                <?php echo $form->error($profile,'name'); ?>
            </div>
        </div>
    </div>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            Yii::t("model","Details {n}",array('{n}'=>1))=>array(
                'content'=>$this->renderPartial(
                    '_fleets_detail_1',
                    array('profile'=>$profile,'form'=>$form,'yachtFoto'=>$yachtFoto),
                    true
                ),
                'id'=>'tab1'
            ),
            Yii::t("model","Details {n}",array('{n}'=>2))=>array(
                'content'=>$this->renderPartial(
                    '_fleets_detail_2',
                    array('profile'=>$profile,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
            Yii::t("model","Photo")=>array(
                'content'=>$this->renderPartial(
                    '_fleets_photo',
                    array('profile'=>$profile,'form'=>$form,'yachtFoto'=>$yachtFoto),
                    true
                ),
                'id'=>'tab3'
            ),
            Yii::t("model","Price")=>array(
                'content'=>$this->renderPartial(
                    '_fleets_price',
                    array('profile'=>$profile,'form'=>$form,'model'=>$model,'priceCurrYear'=>$priceCurrYear,'priceNextYear'=>$priceNextYear),
                    true
                ),
                'id'=>'tab4'
            ),
        ),
        'options'=>$options,
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'fleets_tabs',
        ),
    ));
    ?>

    <?php if(Rights::getAuthorizer()->isSuperuser(Yii::app()->user->id)) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'isActive'); ?>
		<?php echo $form->dropDownList($model,'isActive',$statusList); ?>
		<?php echo $form->error($model,'isActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isTrash'); ?>
		<?php echo $form->dropDownList($model,'isTrash',$statusList); ?>
		<?php echo $form->error($model,'isTrash'); ?>
	</div>
    <?php } ?>

    <div class="row submit">
        <div class="pull-left"><button class="btn btn-default btn_save"><?php echo $model->isNewRecord ? Yii::t('view','Create') : Yii::t('view','Save'); ?></button></div>
    </div>

<?php $this->endWidget(); ?>
<?php
    Yii::app()->clientScript->registerScript("refreshField",'$($("#cc-fleets-form input")[0]).change();',CClientScript::POS_LOAD);
?>
</div><!-- form -->
<script>
    $(function(){
        $(".fleets_form input").tooltip();
        $(".fleets_form select").tooltip();
        $('button[data-type="back"]').on("click",function(event){
            $("#save_mode").val(+$('#fleets_tabs').tabs("option","active")-1);
            $("#cc-fleets-form").submit();
        });
        $('button[data-type="next"]').on("click",function(event){
            $("#save_mode").val(+$('#fleets_tabs').tabs("option","active")+1);
            $("#cc-fleets-form").submit();
        });
        $(".tank_selector").on("change",function(event){
            if($(this).val()!=""){
                $($(this).parent().find(":hidden")[1]).attr("checked",true);
            } else {
                $($(this).parent().find(":hidden")[1]).attr("checked",false);
            }
        });
        $(".btn_save").on("click",function(event){
            $("#save_mode").val(+$('#fleets_tabs').tabs("option","active"));
            $("#fleets_form").submit();
        });
        $('body').on('change','#cc-fleets-form input',function(event){
            $('#cc-fleets-form').data('settings')['submitting'] = true;
            $.fn.yiiactiveform.validate(
                    '#cc-fleets-form',
                    function(messages){
                        var hasError = false;
                        $.each($('#cc-fleets-form').data('settings')['attributes'], function () {
                            hasError = $.fn.yiiactiveform.updateInput(this, messages, $('#cc-fleets-form')) || hasError;
                        });
                        $.fn.yiiactiveform.updateSummary($('#cc-fleets-form'), messages);
                        $.each(messages.fotoValidate.validate,function(id){
                            hasError = !this.valueOf() || hasError;
                            if(!this.valueOf()){
                                $("#"+id+"_link").parent().addClass("error");
                            } else {
                                $("#"+id+"_link").parent().removeClass("error");
                            }
                        });
                        if(hasError){
                            $(".errorSummary").find("ul").append("<li>"+messages.fotoValidate.message+"</li>");
                            if($(".errorSummary:visible").length == 0){
                                $(".errorSummary").show();
                            }
                        }
                    }
            );
            $('#cc-fleets-form').data('settings')['submitting'] = false;
            return false;
        });
        $('body').on('change','.price_curr_year input.hasDatepicker',function(event){
            try{
                var t = $.datepicker.parseDate('dd.mm.yy',$(this).val());
            } catch(e){
                $(this).val('');
                $(this).datepicker('setDate','');
            }
            if($(this).val()!=''){
                var currDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).val()).getTime();
                if(typeof $(this).datepicker('option','maxDate') == 'string'){
                    var maxDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).datepicker('option','maxDate')).getTime();
                } else {
                    var maxDate = $(this).datepicker('option','maxDate').getTime();
                }
                if(typeof $(this).datepicker('option','minDate') == 'string'){
                    var minDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).datepicker('option','minDate')).getTime();
                } else {
                    var minDate = $(this).datepicker('option','minDate').getTime();
                }
                var correct = false;
                if(maxDate<currDate){
                    $(this).val('');
                    $(this).datepicker('setDate','');
                    correct = true;
                }
                if(minDate>currDate){
                    $(this).val('');
                    $(this).datepicker('setDate','');
                    correct = true;
                }
                if(!correct){
                    var pattern = /date_to$/i;
                    if(pattern.test(this.id)){
                        var ID = this.id.replace('date_to','date_from');
                        $('#'+ID).datepicker('option','maxDate',$(this).val());
                        var picker = $($(this).parents('.row.price_curr_year').next('.row').find('input.hasDatepicker')[0]);
                        if(picker.length){
                            var minDate = new Date();
                            var nextDay = currDate+1000*60*60*24;
                            minDate.setTime(nextDay);
                            picker.datepicker('option','minDate',minDate);
                        }
                    } else {
                        var ID = this.id.replace('date_from','date_to');
                        $('#'+ID).datepicker('option','minDate',$(this).val());
                        var picker = $($(this).parents('.row.price_curr_year').prev('.row').find('input.hasDatepicker')[1]);
                        if(picker.length){
                            var maxDate = new Date();
                            var prevDay = currDate-1000*60*60*24;
                            maxDate.setTime(prevDay);
                            picker.datepicker('option','maxDate',maxDate);
                        }
                    }
                }
            }
        });
        $('body').find('.price_curr_year input.hasDatepicker').change();
        $('body').on('change','.price_next_year input.hasDatepicker',function(event){
            try{
                var t = $.datepicker.parseDate('dd.mm.yy',$(this).val());
            } catch(e){
                $(this).val('');
                $(this).datepicker('setDate','');
            }
            if($(this).val()!=''){
                var currDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).val()).getTime();
                if(typeof $(this).datepicker('option','maxDate') == 'string'){
                    var maxDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).datepicker('option','maxDate')).getTime();
                } else {
                    var maxDate = $(this).datepicker('option','maxDate').getTime();
                }
                if(typeof $(this).datepicker('option','minDate') == 'string'){
                    var minDate = $.datepicker.parseDate( 'dd.mm.yy', $(this).datepicker('option','minDate')).getTime();
                } else {
                    var minDate = $(this).datepicker('option','minDate').getTime();
                }
                var correct = false;
                if(maxDate<currDate){
                    $(this).val('');
                    $(this).datepicker('setDate','');
                    correct = true;
                }
                if(minDate>currDate){
                    $(this).val('');
                    $(this).datepicker('setDate','');
                    correct = true;
                }
                if(!correct){
                    var pattern = /date_to$/i;
                    if(pattern.test(this.id)){
                        var ID = this.id.replace('date_to','date_from');
                        $('#'+ID).datepicker('option','maxDate',$(this).val());
                        var picker = $($(this).parents('.row.price_next_year').next('.row').find('input.hasDatepicker')[0]);
                        if(picker.length){
                            var minDate = new Date();
                            var nextDay = currDate+1000*60*60*24;
                            minDate.setTime(nextDay);
                            picker.datepicker('option','minDate',minDate);
                        }
                    } else {
                        var ID = this.id.replace('date_from','date_to');
                        $('#'+ID).datepicker('option','minDate',$(this).val());
                        var picker = $($(this).parents('.row.price_next_year').prev('.row').find('input.hasDatepicker')[1]);
                        if(picker.length){
                            var maxDate = new Date();
                            var prevDay = currDate-1000*60*60*24;
                            maxDate.setTime(prevDay);
                            picker.datepicker('option','maxDate',maxDate);
                        }
                    }
                }
            }
        });
        $('body').find('.price_next_year input.hasDatepicker').change();
    });
</script>