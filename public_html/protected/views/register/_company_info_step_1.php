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
$geoField = Yii::app()->params['geoFieldName'];
if(isset($geoField[Yii::app()->language])){
    $geoField = 'nazvanie_'.$geoField[Yii::app()->language];
} else {
    $geoField = 'nazvanie_2';
}
$country = '';
if(isset($profileCC->company_country_id) && !empty($profileCC->company_country_id)){
    $country = Strana::model()->findByPk($profileCC->company_country_id)->$geoField;
}
$city = '';
if(isset($profileCC->company_city_id) && !empty($profileCC->company_city_id)){
    $city = Gorod::model()->findByPk($profileCC->company_city_id)->$geoField;
}
?>
    <?php echo $form->hiddenField($profileCC,'cc_id'); ?>
    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_name'); ?>
        <?php echo $form->textField($profileCC,'company_name',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_country_id'); ?>
        <?php echo $form->hiddenField($profileCC,'company_country_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'company_country',
            'value'=>$country,
            'source'=>"js:function(request, response) {
                $.getJSON('".$this->createUrl('ajax/autocomplete')."', {
                    term: request.term.split(/,s*/).pop(),
                    modelClass : 'Strana',
                    fName: geoFieldName,
                    create_include : false,
                    sql : false,
                }, response);
            }",
            // additional javascript options for the autocomplete plugin
            'options'=>array(
                'minLength'=>'2',
                'select' =>'js: function(event, ui) {
                    // действие по умолчанию, значение текстового поля
                    // устанавливается в значение выбранного пункта
                    this.value = ui.item.label;
                    // устанавливаем значения скрытого поля
                    $("#CcProfile_company_country_id").val(ui.item.id);
                    $("#CcProfile_company_city_id").val(undefined);
                    $("#company_city").attr("placeholder","'.Yii::t('view','Select city').'");
                    $("#company_city").val("");
                    $("#CcProfile_company_full_addres").val("");
                    //Ищем страну
                    searchFromGeocoder(ui.item.label);
                    return false;
                }',
                'search' => 'js:function( event, ui ) {
                    $(".aL").remove();
                    $("#company_country").after("<img class=aL src=/i/indicator.gif />");
                }',
                'response' => 'js:function( event, ui ) {
                    $(".aL").remove();
                }',
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'company_country_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_city_id'); ?>
        <?php echo $form->hiddenField($profileCC,'company_city_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'company_city',
            'value'=>$city,
            'source'=>"js:function(request, response) {
                $.getJSON('".$this->createUrl('ajax/autocomplete')."', {
                    term: request.term.split(/,s*/).pop(),
                    modelClass : 'Gorod',
                    fName: geoFieldName,
                    parent_id : $('#CcProfile_company_country_id').val(),
                    parent_link : 'strana_id',
                    create_include : false,
                    sql : false,
                }, response);
            }",
            // additional javascript options for the autocomplete plugin
            'options'=>array(
                'minLength'=>'2',
                'select' =>'js: function(event, ui) {
                    // действие по умолчанию, значение текстового поля
                    // устанавливается в значение выбранного пункта
                    this.value = ui.item.label;
                    // устанавливаем значения скрытого поля
                    $("#CcProfile_company_city_id").val(ui.item.id);
                    $("#CcProfile_company_full_addres").val("");
                    //Ищем город
                    searchFromGeocoder(ui.item.label);
                    return false;
                }',
                'search' => 'js:function( event, ui ) {
                    if(+$("#CcProfile_company_country_id").val()<1){
                        return false;
                    }
                    $(".aL").remove();
                    $("#company_city").after("<img class=aL src=/i/indicator.gif />");
                }',
                'response' => 'js:function( event, ui ) {
                    $(".aL").remove();
                }',
            ),
            'htmlOptions' => array(
                'placeholder' => isset($profileCC->company_country_id)?Yii::t('view','Select city'):Yii::t('view','Select country'),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'company_city_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_full_addres'); ?>
        <?php echo $form->textField($profileCC,'company_full_addres',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_full_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_postal_code'); ?>
        <?php echo $form->textField($profileCC,'company_postal_code',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_postal_code'); ?>
    </div>

    <div class="row">
        <div id="map_canvas" style="width:500px; height:300px; display: none;"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'longitude'); ?>
        <?php echo $form->textField($profileCC,'longitude',array('class'=>'form-control geo')); ?>
        <?php echo $form->error($profileCC,'longitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'latitude'); ?>
        <?php echo $form->textField($profileCC,'latitude',array('class'=>'form-control geo')); ?>
        <?php echo $form->error($profileCC,'latitude'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_web_site'); ?>
        <?php echo $form->textField($profileCC,'company_web_site',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_web_site'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_email'); ?>
        <?php echo $form->textField($profileCC,'company_email',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_phone'); ?>
        <?php echo $form->textField($profileCC,'company_phone',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_faxe'); ?>
        <?php echo $form->textField($profileCC,'company_faxe',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'company_faxe'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'q_boat'); ?>
        <?php echo $form->textField($profileCC,'q_boat',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'q_boat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'company_logo'); ?>
        <?php
            echo CHtml::image(isset($profileCC->company_logo)?$profileCC->company_logo:'/i/def/avatar.png','',array('id'=>'CompanyLogo','class'=>'avatar_img'));
            echo $form->hiddenField($profileCC,'company_logo');
        ?>
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
                                $('#CcProfile_company_logo').val(response.link);
                                $('#CompanyLogo').attr('src',response.link);
                                $('.qq-upload-list').children().fadeOut(1000,function(){ $('.qq-upload-list').empty() });
                            }
                        }",
                        'onError'=>"js:function(id, name, errorReason){
                            $('#CcProfile_company_logo').val();
                            alert(errorReason);
                        }",
                    ),
                    'validation'=>array(
                        'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                        'sizeLimit'=>10*1024*1024,//maximum file size in bytes
//                        'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                    ),
                ),
                'htmlOptions'=>array(
                    'id'=>'UploadCompanyLogo',
                    'style'=>'margin-top:5px;'
                ),
            )
        );
        ?>
        <?php echo $form->error($profileCC,'company_logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'ccLanguages'); ?>
        <div class="row">
            <div class="btn-group" data-toggle="buttons">
                <?php
                $availableLang = Language::model()->getModelList('name','',array('order'=>'name','condition'=>'isActive = 1'));
                $selectedLang = $profileCC->getSelectedLanguage();
                $name = "CcProfile[ccLanguages][]";
                foreach($availableLang as $i => $l){
                    echo CHtml::label(CHtml::checkBox($name,isset($selectedLang[$i]),array('value'=>$i)).$l,'',array('class'=>'btn btn-default lang_check'.(isset($selectedLang[$i])?' active':'')));
                }
                ?>
            </div>
        </div>
        <?php echo $form->error($profileCC,'ccLanguages'); ?>
    </div>
<?php if($this->id=="profile"){?>
    <div class="row">
        <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
        <div class="pull-right"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Next"); ?></button></div>
    </div>
<?php } ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=true&language=<?php echo Yii::app()->language; ?>"></script>
<script type="text/javascript">
    geoFieldName = 'nazvanie_<?php
        $geo = Yii::app()->params['geoFieldName'];
        echo isset($geo[Yii::app()->language])?$geo[Yii::app()->language]:2;
    ?>';
    appLng = '<?php echo Yii::app()->language; ?>';
    $(function(){
        $('.lang_check').button();
        $("#CcProfile_company_full_addres").change(function(event){
            searchFromGeocoder($(this).val());
        });
        $('#company_tabs').tabs({
            activate: function(event,ui) {
                if(ui.newPanel.selector=="#tab2"){
                    initialize();
                }
            }
        });
        $("#CcProfile_company_name").change(function(event){
            marker.setTitle($(this).val());
        });
        $(".geo").change(function(){
            var pattern = /^\d+(\.\d+)?$/;
            var lat = $("#CcProfile_latitude").val();
            var lon = $("#CcProfile_longitude").val();
            if(pattern.test(lat) && pattern.test(lon)){
                initialize({latitude:lat,longitude:lon});
                moveMarker({lat:lat,lng:lon});
            }
        });
    });
</script>

