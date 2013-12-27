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
$countryList = Strana::model()->getModelList('nazvanie_1',' - ',array('order'=>'nazvanie_1'));
?>
    <?php echo $form->hiddenField($profileCC,'cc_id'); ?>
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
                    fName : ["nazvanie_1","nazvanie_2"],
                    parent_id : $(this).val(),
                    parent_link : "g.strana_id",
                    parent_model : "strana",
                    parent_include : false,
                    create_include : false,
                    sql : true,
                }',
                'beforeSend'=>'js: function(xhr,settings){
                    $("#CcProfile_company_city_id").after("<img class=aL src=/i/indicator.gif />");
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
                    $(".aL").remove();
                    if(answer.length){
                        $.ajax({
                            type: "POST",
                            url: "'.$this->createUrl('ajax/getcityll').'",
                            data: {id: $("#CcProfile_company_city_id").val()},
                            dataType: "json",
                            success: function(answer){
                                if(!answer.success){
                                    alert(answer.data);
                                } else {
                                    initialize(answer.data);
                                }
                            }
                        });
                    }
                }', //selector to update
            )));
        ?>
        <?php echo $form->error($profileCC,'company_country_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_city_id'); ?>
        <?php echo $form->dropDownList($profileCC,'company_city_id',array(),array(
            'prompt'=>Yii::t('view','Select country'),
            'ajax' => array(
                'type'=>'POST',
                'dataType'=>'json',
                'url'=>$this->createUrl('ajax/getcityll'),
                'data'=>'js:{
                    id: $(this).val()
                }',
                'success'=>'js: function(answer){
                    if(!answer.success){
                        alert(answer.data);
                    } else {
                        initialize(answer.data);
                    }
                }',
            )
        )); ?>
        <?php echo $form->error($profileCC,'company_city_id'); ?>
    </div>

    <div class="row">
        <div id="map_canvas" style="width:500px; height:300px; display: none;"></div>
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
        <?php echo $form->labelEx($profileCC,'q_boat'); ?>
        <?php echo $form->textField($profileCC,'q_boat'); ?>
        <?php echo $form->error($profileCC,'q_boat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_logo'); ?>
        <?php echo $form->fileField($profileCC,'company_logo'); ?>
        <?php echo $form->error($profileCC,'company_logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_speak'); ?>
        <?php echo $form->textField($profileCC,'company_speak'); ?>
        <?php echo $form->error($profileCC,'company_speak'); ?>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=false"></script>
<script type="text/javascript">
    var map;
    function initialize(param) {
        var mapOptions = {
            zoom: 11,
            center: new google.maps.LatLng(param.latitude, param.longitude)
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
                mapOptions);
        $("#map_canvas").show();
        $("#CcProfile_longitude").val(param.longitude);
        $("#CcProfile_latitude").val(param.latitude);
    }
</script>
