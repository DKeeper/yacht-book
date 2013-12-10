<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 10.12.13
 * @time 14:45
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileCC CCProfile */
/* @var $form CActiveForm */
$countryList = Strana::model()->getModelList('samonazvanie',' - ',array('order'=>'samonazvanie'));
?>
<div class="form">
    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_name'); ?>
        <?php echo $form->textField($profileCC,'company_name'); ?>
        <?php echo $form->error($profileCC,'company_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_country_id'); ?>
        <?php echo $form->dropDownList($profileCC,'company_country_id',$countryList,
        array(
            'prompt'=>Yii::t('view','Select country'),
            'ajax' => array(
                'type'=>'POST', //request type
                'dataType'=>'json',
                'url'=>$this->createUrl('ajax/autocomplete'), //url to call.
                'data'=>'js:{
                    term : "",
                    modelClass : "Gorod",
                    fName : "samonazvanie",
                    parent_id : $(this).val(),
                    parent_link : "strana_id",
                    parent_model : "strana",
                    parent_include : false,
                    create_include : false,
                }',
                'success'=>'js: function(answer){
                    var o = "";
                    if(answer.length){
                        $.each(answer,function(){
                            o += "<option value="+this.id+">"+this.label+"</option>";
                        });
                    } else {
                        o += "<option>'.Yii::t('view','No data').'</option>";
                    }
                    $("#CcProfile_company_city_id").empty().append(o);
                }', //selector to update
            )));
        ?>
        <?php echo $form->error($profileCC,'company_country_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_city_id'); ?>
        <?php echo $form->dropDownList($profileCC,'company_city_id',array(),array('prompt'=>Yii::t('view','Select country'))); ?>
        <?php echo $form->error($profileCC,'company_city_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_postal_code'); ?>
        <?php echo $form->textField($profileCC,'company_postal_code'); ?>
        <?php echo $form->error($profileCC,'company_postal_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_full_addres'); ?>
        <?php echo $form->textField($profileCC,'company_full_addres'); ?>
        <?php echo $form->error($profileCC,'company_full_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_web_site'); ?>
        <?php echo $form->textField($profileCC,'company_web_site'); ?>
        <?php echo $form->error($profileCC,'company_web_site'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_email'); ?>
        <?php echo $form->textField($profileCC,'company_email'); ?>
        <?php echo $form->error($profileCC,'company_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_phone'); ?>
        <?php echo $form->textField($profileCC,'company_phone'); ?>
        <?php echo $form->error($profileCC,'company_phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_faxe'); ?>
        <?php echo $form->textField($profileCC,'company_faxe'); ?>
        <?php echo $form->error($profileCC,'company_faxe'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'vat'); ?>
        <?php echo $form->textField($profileCC,'vat'); ?>
        <?php echo $form->error($profileCC,'vat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_logo'); ?>
        <?php echo $form->fileField($profileCC,'company_logo'); ?>
        <?php echo $form->error($profileCC,'company_logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'q_boat'); ?>
        <?php echo $form->textField($profileCC,'q_boat'); ?>
        <?php echo $form->error($profileCC,'q_boat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_speak'); ?>
        <?php echo $form->textField($profileCC,'company_speak'); ?>
        <?php echo $form->error($profileCC,'company_speak'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'longitude'); ?>
        <?php echo $form->textField($profileCC,'longitude'); ?>
        <?php echo $form->error($profileCC,'longitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'latitude'); ?>
        <?php echo $form->textField($profileCC,'latitude'); ?>
        <?php echo $form->error($profileCC,'latitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_name'); ?>
        <?php echo $form->textField($profileCC,'bank_name'); ?>
        <?php echo $form->error($profileCC,'bank_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_addres'); ?>
        <?php echo $form->textField($profileCC,'bank_addres'); ?>
        <?php echo $form->error($profileCC,'bank_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary'); ?>
        <?php echo $form->textField($profileCC,'beneficiary'); ?>
        <?php echo $form->error($profileCC,'beneficiary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary_addres'); ?>
        <?php echo $form->textField($profileCC,'beneficiary_addres'); ?>
        <?php echo $form->error($profileCC,'beneficiary_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'account_no'); ?>
        <?php echo $form->textField($profileCC,'account_no'); ?>
        <?php echo $form->error($profileCC,'account_no'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'swift'); ?>
        <?php echo $form->textField($profileCC,'swift'); ?>
        <?php echo $form->error($profileCC,'swift'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'iban'); ?>
        <?php echo $form->textField($profileCC,'iban'); ?>
        <?php echo $form->error($profileCC,'iban'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'visa'); ?>
        <?php echo $form->checkBox($profileCC,'visa'); ?>
        <?php echo $form->error($profileCC,'visa'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'visa_percent'); ?>
        <?php echo $form->textField($profileCC,'visa_percent'); ?>
        <?php echo $form->error($profileCC,'visa_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'mastercard'); ?>
        <?php echo $form->checkBox($profileCC,'mastercard'); ?>
        <?php echo $form->error($profileCC,'mastercard'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'mastercard_percent'); ?>
        <?php echo $form->textField($profileCC,'mastercard_percent'); ?>
        <?php echo $form->error($profileCC,'mastercard_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'amex'); ?>
        <?php echo $form->checkBox($profileCC,'amex'); ?>
        <?php echo $form->error($profileCC,'amex'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'amex_percent'); ?>
        <?php echo $form->textField($profileCC,'amex_percent'); ?>
        <?php echo $form->error($profileCC,'amex_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_transfer'); ?>
        <?php echo $form->checkBox($profileCC,'bank_transfer'); ?>
        <?php echo $form->error($profileCC,'bank_transfer'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'western_union'); ?>
        <?php echo $form->checkBox($profileCC,'western_union'); ?>
        <?php echo $form->error($profileCC,'western_union'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'contact'); ?>
        <?php echo $form->checkBox($profileCC,'contact'); ?>
        <?php echo $form->error($profileCC,'contact'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'others'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'others',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'others'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_day'); ?>
        <?php echo $form->textField($profileCC,'checkin_day'); ?>
        <?php echo $form->error($profileCC,'checkin_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_hour'); ?>
        <?php echo $form->textField($profileCC,'checkin_hour'); ?>
        <?php echo $form->error($profileCC,'checkin_hour'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_day'); ?>
        <?php echo $form->textField($profileCC,'checkout_day'); ?>
        <?php echo $form->error($profileCC,'checkout_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_hour'); ?>
        <?php echo $form->textField($profileCC,'checkout_hour'); ?>
        <?php echo $form->error($profileCC,'checkout_hour'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'payment_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'payment_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'payment_other'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'cancel_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'cancel_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'cancel_other'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'repeater_discount'); ?>
        <?php echo $form->textField($profileCC,'repeater_discount'); ?>
        <?php echo $form->error($profileCC,'repeater_discount'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'max_discount'); ?>
        <?php echo $form->textField($profileCC,'max_discount'); ?>
        <?php echo $form->error($profileCC,'max_discount'); ?>
    </div>
</div><!-- form -->