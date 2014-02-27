<?php
/* @var $this MapController */
/** @var $profile SyProfile */
/** @var $length array */
/** @var $date array */
/** @var $price array */
$profile = SyProfile::model();
?>
<style>
    .map_view .row{
        margin: 0;
    }
    .map_view .panel-body{
        padding: 5px;
    }
    .container-fluid {
        position: absolute;
        width: 80%;
        z-index: 1000;
        top: 0;
    }
    .container-fluid .panel{
        margin-bottom: 1px;
    }
    .ui-autocomplete {
        max-height: 150px;
        overflow-y: auto;
    }
    .filters{
        font-size: 10px;
    }
    .filters .col-md-4{
        padding: 0 1px;
    }
    .filters .col-md-3{
        padding: 0 6px;
    }
    .input-esm {
        height: 20px;
        padding: 3px 5px;
        font-size: 10px;
        line-height: 1.5;
        border-radius: 3px;
    }
    ul.ui-autocomplete.ui-menu.ui-widget,
    div.ui-slider.ui-slider-horizontal.ui-widget
    {
        font-size: 10px;
    }
</style>
<div id="page" class="container-fluid map_view">
    <div class="panel panel-default">
        <div class="panel-body">
            Шапка (заглушка)
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10">
                    <?php echo CHtml::telField('','',array('id'=>'address','class'=>'form-control input-sm')); ?>
                </div>
                <div class="col-md-2 text-center">
                    <?php echo CHtml::button(Yii::t("view","Search"),array('id'=>'search-btn','class'=>'btn btn-default input-sm')); ?>
                </div>
            </div>
            <div class="row">
                Календарь (заглушка)
            </div>
            <div class="row filters">
                <?php
                $form = $this->beginWidget(
                    'CActiveForm',
                    array(
                        'id'=>'search-form',
                        'action'=>'/ajax/mapsearch'
                    )
                );
                ?>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <?php
                        echo CHtml::activeHiddenField($profile,'type_id',array('id'=>'Search_type_id','name'=>'Search[type_id]'));
                        $model = YachtType::model();
                        $this->widget('autocombobox.JuiAutoComboBox', array(
                            'model'=>$model,   // модель
                            'attribute'=>'name',  // атрибут модели
                            // "источник" данных для выборки
                            'source' =>'js:function(request, response) {
                                $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                                term: request.term.split(/,s*/).pop(),
                                modelClass: "YachtType",
                                parent_include: false,
                                create_include: false,
                                sql: false
                            }, response);}',
                            // параметры, подробнее можно посмотреть на сайте
                            // http://jqueryui.com/demos/autocomplete/
                            'options'=>array(
                                'minLength'=>0,
                                'delay'=>0,
                                'showAnim'=>'fold',
                                'click'=>'js: function(event, ui) {
                                    $(this).val("");
                                    $("#YachtType_name").autocomplete( "search","");
                                    return false;}',
                                'select' =>'js: function(event, ui) {
                                    this.value = ui.item.value;
                                    // записываем полученный id в скрытое поле
                                    $("#Search_type_id").val(ui.item.id);
                                    $("#Search_shipyard_id").val("");
                                    $("#Search_model_id").val("");
                                    $("#YachtShipyard_name").val("");
                                    $("#YachtModel_name").val("");
                                    applyFilters();
                                    return false;
                                }',
                                'change' => 'js: function(event, ui) {
                                    if(ui.item===null){
                                        $("#Search_type_id").val("");
                                    }
                                    return false;
                                }',
                                'response' => 'js: function( event, ui ) {
                                    if(autoFind){
                                        var s = ui.content[0];
                                        $("#Search_type_id").val(s.id);
                                        this.value = s.value;
                                        autoFind = false;
                                        applyFilters();
                                        return false;
                                }}',
                                'open' => 'js: function( event, ui ) {
                                    if(hideSearchResult){
                                    $(this).autocomplete("close");
                                    hideSearchResult = false;
                                }}',
                                'close' => 'js: function( event, ui ) {
                                    if($(this).val()===""){
                                        $("#Search_type_id").val("");
                                        $("#Search_shipyard_id").val("");
                                        $("#Search_model_id").val("");
                                        $("#YachtShipyard_name").val("");
                                        $("#YachtModel_name").val("");
                                }}',
                            ),
                            'htmlOptions' => array(
                                'placeholder'=>$profile->getAttributeLabel("type_id"),
                                'title'=>$profile->getAttributeLabel("type_id"),
                                'class'=>'form-control input-esm'
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo CHtml::activeHiddenField($profile,'shipyard_id',array('id'=>'Search_shipyard_id','name'=>'Search[shipyard_id]'));
                        $model = YachtShipyard::model();
                        $this->widget('autocombobox.JuiAutoComboBox', array(
                            'model'=>$model,   // модель
                            'attribute'=>'name',  // атрибут модели
                            // "источник" данных для выборки
                            'source' =>'js:function(request, response) {
                                $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                                    term: request.term.split(/,s*/).pop(),
                                    parent_id: $("#Search_type_id").val(),
                                    parent_link: "yacht_type_id",
                                    parent_model: "yachtType",
                                    modelClass: "YachtShipyard",
                                    field: {yachtType: "name"},
                                    create_include: false,
                                    sql: false
                                }, response);
                            }',
                            // параметры, подробнее можно посмотреть на сайте
                            // http://jqueryui.com/demos/autocomplete/
                            'options'=>array(
                                'minLength'=>0,
                                'delay'=>0,
                                'showAnim'=>'fold',
                                'click'=>'js: function(event, ui) {
                                    $(this).val("");
                                    $("#YachtShipyard_name").autocomplete( "search","");
                                    return false;
                                }',
                                'select' =>'js: function(event, ui) {
                                    if(!ui.item.id){
                                        createAddForm("#c","shipyard");
                                        $(".custom_create").click();
                                    } else {
                                        this.value = ui.item.value;
                                        // записываем полученный id в скрытое поле
                                        $("#Search_shipyard_id").val(ui.item.id);
                                        $("#Search_model_id").val("");
                                        $("#YachtModel_name").val("");
                                        autoFind = true;
                                        hideSearchResult = true;
                                        $("#YachtType_name").autocomplete( "search",ui.item.parent_name);
                                    }
                                    return false;
                                }',
                                'change' => 'js: function(event, ui) {
                                    if(ui.item===null){
                                        $("#Search_shipyard_id").val("");
                                    }
                                    return false;
                                }',
                                'response' => 'js: function( event, ui ) {
                                    if(autoFind){
                                        var s = ui.content[0];
                                        $("#Search_shipyard_id").val(s.id);
                                        this.value = s.value;
                                        $("#YachtType_name").autocomplete( "search",s.parent_name);
                                        return false;
                                    }
                                }',
                                'open' => 'js: function( event, ui ) {
                                    if(hideSearchResult){
                                        $(this).autocomplete("close");
                                    }
                                }',
                            ),
                            'htmlOptions' => array(
                                'placeholder'=>$profile->getAttributeLabel("shipyard_id"),
                                'title'=>$profile->getAttributeLabel("shipyard_id"),
                                'class'=>'form-control input-esm'
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo CHtml::activeHiddenField($profile,'model_id',array('id'=>'Search_model_id','name'=>'Search[model_id]'));
                        $model = YachtModel::model();
                        $this->widget('autocombobox.JuiAutoComboBox', array(
                            'model'=>$model,   // модель
                            'attribute'=>'name',  // атрибут модели
                            // "источник" данных для выборки
                            'source' =>'js:function(request, response) {
                                $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                                    term: request.term.split(/,s*/).pop(),
                                    parent_id: $("#Search_shipyard_id").val(),
                                    parent_link: "shipyard_id",
                                    parent_model: "shipyard",
                                    modelClass: "YachtModel",
                                    field: {shipyard: "name"},
                                    create_include: false,
                                    sql: false
                                },response);
                            }',
                            // параметры, подробнее можно посмотреть на сайте
                            // http://jqueryui.com/demos/autocomplete/
                            'options'=>array(
                                'minLength'=>0,
                                'delay'=>0,
                                'showAnim'=>'fold',
                                'click'=>'js: function(event, ui) {
                                    $(this).val("");
                                    $("#YachtModel_name").autocomplete( "search","");
                                    return false;
                                }',
                                'select' =>'js: function(event, ui) {
                                    if(!ui.item.id){
                                        createAddForm("#c","model");
                                        $(".custom_create").click();
                                    } else {
                                        this.value = ui.item.value;
                                        // записываем полученный id в скрытое поле
                                        $("#Search_model_id").val(ui.item.id);
                                        $("#Search_shipyard_id").val(ui.item.parent_id);
                                        autoFind = true;
                                        hideSearchResult = true;
                                        $("#YachtShipyard_name").autocomplete( "search",ui.item.parent_name);
                                    }
                                    return false;
                                }',
                                'change' => 'js: function(event, ui) {
                                    if(ui.item===null){
                                        $("#Search_model_id").val("");
                                    }
                                    return false;
                                }',
                                'response' => 'js: function( event, ui ) {
                                    if(autoFind){
                                        var s = ui.content[0];
                                        $("#Search_model_id").val(s.id);
                                        this.value = s.value;
                                        $("#YachtShipyard_name").autocomplete( "search",s.parent_name);
                                        return false;
                                    }
                                }',
                                'open' => 'js: function( event, ui ) {
                                    if(hideSearchResult){
                                        $(this).autocomplete("close");
                                    }
                                }',
                            ),
                            'htmlOptions' => array(
                                'placeholder'=>$profile->getAttributeLabel("model_id"),
                                'title'=>$profile->getAttributeLabel("model_id"),
                                'class'=>'form-control input-esm'
                            ),
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center">
                        <?php echo Yii::t("view","length"); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiSliderInput',array(
                            'id'=>'Search_length',
                            'name'=>'Search[length][min]',
                            'value'=>$length['l_min'],
                            'maxName'=>'Search[length][max]',
                            'maxValue'=>$length['l_max'],
                            // additional javascript options for the slider plugin
                            'options'=>array(
                                'min'=>$length['l_min'],
                                'max'=>$length['l_max'],
                                'range'=>true,
                                'values'=>array($length['l_min'],$length['l_max']),
                                'stop'=>'js: function(event,ui){applyFilters()}',
                            ),
                            'htmlOptions'=>array(
//                                'style'=>'height:20px;',
                            ),
                        ));
                        ?>
                        <div id="Search_length_min" class="pull-left"><?php echo $length['l_min']; ?></div>
                        <div id="Search_length_max" class="pull-right"><?php echo $length['l_max']; ?></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo Yii::t("view","cabins"); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiSliderInput',array(
                            'id'=>'Search_cabins',
                            'name'=>'Search[cabins][min]',
                            'value'=>2,
                            'maxName'=>'Search[cabins][max]',
                            'maxValue'=>10,
                            // additional javascript options for the slider plugin
                            'options'=>array(
                                'min'=>2,
                                'max'=>10,
                                'range'=>true,
                                'values'=>array(2,10),
                                'stop'=>'js: function(event,ui){applyFilters()}',
                            ),
                            'htmlOptions'=>array(
//                                'style'=>'height:20px;',
                            ),
                        ));
                        ?>
                        <div id="Search_cabins_min" class="pull-left"></div>
                        <div id="Search_cabins_max" class="pull-right"></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo Yii::t("view","year"); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiSliderInput',array(
                            'id'=>'Search_year',
                            'name'=>'Search[year][min]',
                            'value'=>$date['b_date_min'],
                            'maxName'=>'Search[year][max]',
                            'maxValue'=>$date['b_date_max'],
                            // additional javascript options for the slider plugin
                            'options'=>array(
                                'min'=>$date['b_date_min'],
                                'max'=>$date['b_date_max'],
                                'range'=>true,
                                'values'=>array($date['b_date_min'],$date['b_date_max']),
                                'stop'=>'js: function(event,ui){applyFilters()}',
                            ),
                            'htmlOptions'=>array(
//                                'style'=>'height:20px;',
                            ),
                        ));
                        ?>
                        <div id="Search_year_min" class="pull-left"><?php echo $date['b_date_min']; ?></div>
                        <div id="Search_year_max" class="pull-right"><?php echo $date['b_date_max']; ?></div>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo Yii::t("view","price"); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiSliderInput',array(
                            'id'=>'Search_price',
                            'name'=>'Search[price][min]',
                            'value'=>$price['price_min'],
                            'maxName'=>'Search[price][max]',
                            'maxValue'=>$price['price_max'],
                            // additional javascript options for the slider plugin
                            'options'=>array(
                                'min'=>$price['price_min'],
                                'max'=>$price['price_max'],
                                'range'=>true,
                                'values'=>array($price['price_min'],$price['price_max']),
                                'stop'=>'js: function(event,ui){applyFilters()}',
                            ),
                            'htmlOptions'=>array(
//                                'style'=>'height:20px;',
                            ),
                        ));
                        ?>
                        <div id="Search_price_min" class="pull-left"><?php echo $price['price_min']; ?></div>
                        <div id="Search_price_max" class="pull-right"><?php echo $price['price_max']; ?></div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<div id="map_container" class="map_container">
</div>
<script>
    $(function(){
        var mapData = {id:'map_search'};
        var mapOptions = {
            panControl: true,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE
            },
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            scaleControl: true,
            streetViewControl: false,
            overviewMapControl: false
        };
        mapOptions['center'] = new google.maps.LatLng(0, 0);
        mapOptions['zoom'] = 2;
        mapData['map'] = new google.maps.Map(document.getElementById('map_container'),mapOptions);
        mapData['geocoder'] = new google.maps.Geocoder();
        map.push(mapData);
        $("#map_container").show();
        $("#address").on("change",function(event){
            codeAddress();
        });
        $("#search-btn").on("click",function(event){
            codeAddress();
        });
        $('#Search_length_slider').on("slide",function( event, ui ) {
            $(this).parent().find("#Search_length_min").empty().append(ui.values[0]);
            $(this).parent().find("#Search_length_max").empty().append(ui.values[1]);
        });
        $('#Search_cabins_slider').on("slide",function( event, ui ) {
            $(this).parent().find("#Search_cabins_min").empty().append(ui.values[0]);
            $(this).parent().find("#Search_cabins_max").empty().append(ui.values[1]);
        });
        $('#Search_year_slider').on("slide",function( event, ui ) {
            $(this).parent().find("#Search_year_min").empty().append(ui.values[0]);
            $(this).parent().find("#Search_year_max").empty().append(ui.values[1]);
        });
        $('#Search_price_slider').on("slide",function( event, ui ) {
            $(this).parent().find("#Search_price_min").empty().append(ui.values[0]);
            $(this).parent().find("#Search_price_max").empty().append(ui.values[1]);
        });
        $(window).resize(function(){
            $('.container-fluid').css({
                left: ($(document).width() - $('.container-fluid').outerWidth())/2
            });

        });
        $(window).resize();
    });
    function codeAddress() {
        var mapData = {};
        $.each(map,function(){
            if(this.id==="map_search"){
                mapData = this;
                return false;
            }
        });
        var address = $('#address').val();
        if(address!==""){
            mapData.geocoder.geocode( {'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    mapData.map.setCenter(results[0].geometry.location);
                    mapData.map.setZoom(10);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    }
    function applyFilters(){
        var $form = $("#search-form");
        $.ajax({
            url:$form.attr("action"),
            data: $form.serialize(),
            success:function(answer){
                if(!answer.success){
                    alert(answer.data);
                } else {
                    alert("Найдено лодок: "+answer.data.count);
                }
            },
            type:'POST',
            dataType:'json',
            async:true
        });
    }
</script>