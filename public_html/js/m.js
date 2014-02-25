/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.12.13
 * @time 10:08
 * Created by JetBrains PhpStorm.
 */
var autoFind = false;
var hideSearchResult = false;
var currentObj;
var map = [];
var marker;
var geocoder;
var city_id=-1;
var country_id=-1;
var geoFieldName;
var appLng;
var selectedLanguage = [];
function createAddForm(o,type,currObj,success){
    $(o).empty();
    var model, pId, pLink;
    switch (type){
        case 'order_options':
            model = 'OrderOptions';
            currentObj = currObj;
            break;
        case 'shipyard':
            model = 'YachtShipyard';
            currentObj = "#YachtShipyard_name";
            break;
        case 'model':
            model = 'YachtModel';
            currentObj = "#YachtModel_name";
            pId = $("#SyProfile_shipyard_id").val();
            pLink = "shipyard_id";
            break;
        case 'index':
            model = 'YachtIndex';
            currentObj = "#YachtIndex_name";
            pId = $("#SyProfile_model_id").val();
            pLink = "model_id";
            break;
        case 'modification':
            model = 'YachtModification';
            currentObj = "#YachtModification_name";
            pId = $("#SyProfile_model_id").val();
            pLink = "model_id";
            break;
    }
    $.ajax({
        url:'/ajax/icreate',
        data:{view:'_form',model:model,pId:pId,pLink:pLink},
        success:function(answer){
            showAjaxForm(o,answer,success);
        },
        type:'POST',
        dataType:'html',
        async:true
    });
}
function showAjaxForm(o,answer,success){
    $(o).empty().append(answer).find("form").on("submit",function(event){
        $.ajax({
            url:'/ajax/icreate',
            data: $(this).serialize(),
            success:function(answer){
                if(answer==="create done"){
                    if(typeof success !== "undefined"){
                        success.call();
                    }
                    $(".fancybox-close").click();
                } else {
                    showAjaxForm(o,answer);
                }
            },
            type:'POST',
            dataType:'html',
            async:true
        });
        return false;
    });
}
function initialize(mapData,mapId,param,search,modelPrefix) {
    var f = false;
    $.each(map,function(i){
        if(this.id==mapData.id){
            mapData=map[i];
            f = true;
            return false;
        }
    });
    search = search || false;
    var mapOptions = {
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        scaleControl: true,
        streetViewControl: false,
        overviewMapControl: false
    };
    if(typeof param != "undefined" && !$.isEmptyObject(param)){
        mapOptions['center'] = new google.maps.LatLng(param.latitude, param.longitude);
        mapOptions['zoom'] = 11;
    } else {
        if($('#'+modelPrefix+'_longitude').val()!="" && $('#'+modelPrefix+'_latitude').val()!=""){
            mapOptions['center'] = new google.maps.LatLng($('#'+modelPrefix+'_latitude').val(), $('#'+modelPrefix+'_longitude').val());
            mapOptions['zoom'] = 11;
        } else {
            mapOptions['center'] = new google.maps.LatLng(0, 0);
            mapOptions['zoom'] = 1;
        }
    }
    mapData['map'] = new google.maps.Map(document.getElementById(mapId),mapOptions);
    mapData['marker'] = new google.maps.Marker({
        position: mapData.map.getCenter(),
        map: mapData.map,
        draggable: true
    });
    mapData['geocoder'] = new google.maps.Geocoder();
    if(search){
        google.maps.event.addListener(mapData.map, 'click', function(event) {
            mapData.marker.setPosition(event.latLng);
            moveMarker(mapData);
            searchByGeocoder({lat:event.latLng.lat(),lng:event.latLng.lng()},appLng.slice(0,2));
            setGeoValue({lat:event.latLng.lat(),lng:event.latLng.lng()},modelPrefix);
        });
        google.maps.event.addListener(mapData.marker, "dragend", function(event) {
            moveMarker(mapData);
            searchByGeocoder({lat:event.latLng.lat(),lng:event.latLng.lng()},appLng.slice(0,2));
            setGeoValue({lat:event.latLng.lat(),lng:event.latLng.lng()},modelPrefix);
        });
    } else {
        google.maps.event.addListener(mapData.map, 'click', function(event) {
            mapData.marker.setPosition(event.latLng);
            moveMarker(mapData);
            setGeoValue({lat:event.latLng.lat(),lng:event.latLng.lng()},modelPrefix);
        });
        google.maps.event.addListener(mapData.marker, "dragend", function(event) {
            moveMarker(mapData);
            setGeoValue({lat:event.latLng.lat(),lng:event.latLng.lng()},modelPrefix);
        });
    }
    $("#"+mapId).show();
    if(typeof param != "undefined" && !$.isEmptyObject(param)){
        $("#"+modelPrefix+"_longitude").val(param.longitude);
        $("#"+modelPrefix+"_latitude").val(param.latitude);
    }
    if(!f){
        map.push(mapData);
    }
}

function searchFromGeocoder(a,find,mapObjId){
    var mapData = {};
    $.each(map,function(){
        if(this.id===mapObjId){
            mapData = this;
            return false;
        }
    });
    find = find || false;
    if($.isEmptyObject(mapData)){
        return false;
    }
    mapData.geocoder.geocode( {address:a,bounds:mapData.map.getBounds()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            mapData.marker.setPosition(results[0].geometry.location);
            mapData.map.fitBounds(results[0].geometry.viewport);
            setGeoValue({lat:results[0].geometry.location.ob,lng:results[0].geometry.location.pb},mapData.id);
            if(find){
                moveMarker(mapData);
                searchByGeocoder({lat:results[0].geometry.location.nb,lng:results[0].geometry.location.mb},appLng.slice(0,2));
            }
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

function searchByGeocoder(latLng,lang){
    $("#CcProfile_company_full_addres").after("<img class=aL src=/i/indicator.gif />");
    var addressForDb = {};
    $.ajax({
        url:'http://maps.googleapis.com/maps/api/geocode/json',
        data: {latlng:latLng.lat+','+latLng.lng,sensor:false,language:lang},
        success:function(answer){
            if(answer.status === "OK"){
                $("#CcProfile_company_full_addres").val(answer.results[0].formatted_address);
                $(".aL").remove();
                $.each(answer.results[0].address_components,function(){
                    switch(this.types[0]){
                        case 'street_number':
                            break;
                        case 'route':
                            addressForDb['street']=this.long_name;
                            break;
                        case 'locality':
                            addressForDb['city']=this.long_name;
                            break;
                        case 'administrative_area_level_2':
                            break;
                        case 'administrative_area_level_1':
                            break;
                        case 'country':
                            addressForDb['country']=this.long_name;
                            break;
                        case 'postal_code':
                            $("#CcProfile_company_postal_code").val(this.long_name);
                            break;
                    }
                });
                var city='';
                if(typeof addressForDb.street != "undefined"){
                    city = addressForDb.street.replace(/(.+)?\((.+)?\)/,'$2');
                    if(city===addressForDb.street){
                        city='';
                    }
                }
                if(typeof addressForDb.city != "undefined"){
                    if(city===''){
                        switch(appLng){
                            case 'en':
                            case 'en-GB':
                                city = addressForDb.city.replace(/\scity/,'');
                                city = addressForDb.city.replace(/gorod\s/,'');
                                break;
                            case 'ru':
                                city = addressForDb.city.replace(/город\s/,'');
                                break;
                        }
                    }
                }
                if(typeof addressForDb.country != "undefined"){
                    $("#company_country").after("<img class=aL src=/i/indicator.gif />");
                    //Поиск страны
                    $.ajax({
                        url:'/ajax/findgeoobject',
                        data: {type:'country',value:addressForDb.country,field:geoFieldName},
                        success:function(answer){
                            if(answer.success){
                                country_id = answer.data.id;
                                $("#company_country").val(answer.data.value);
                            } else {
                                alert(answer.data);
                                $("#company_country").val("");
                                country_id = undefined;
                            }
                            $("#CcProfile_company_country_id").val(country_id).change();
                            $(".aL").remove();
                            if(typeof addressForDb.city != "undefined"){
                                $("#company_city").after("<img class=aL src=/i/indicator.gif />");
                                // Поиск города
                                $.ajax({
                                    url:'/ajax/findgeoobject',
                                    data: {type:'city',value:city,field:geoFieldName,parent_link:'strana_id',parent_value:country_id},
                                    success:function(answer){
                                        if(answer.success){
                                            city_id = answer.data.id;
                                            $("#company_city").val(answer.data.value);
                                        } else {
                                            alert(answer.data);
                                            $("#company_city").val("");
                                            city_id = undefined;
                                        }
                                        $("#CcProfile_company_city_id").val(city_id).change();
                                        $(".aL").remove();
                                    },
                                    type:'POST',
                                    dataType:'json',
                                    async:true
                                });
                            } else {
                                // Не найден город
                                $("#company_city").val("");
                                city_id = undefined;
                                $("#CcProfile_company_city_id").val(city_id).change();
                            }
                        },
                        type:'POST',
                        dataType:'json',
                        async:true
                    });
                } else {
                    //Не найдена страна
                    $("#company_country").val("");
                    country_id = undefined;
                    $("#CcProfile_company_country_id").val(country_id);
                    $("#company_city").val("");
                    city_id = undefined;
                    $("#CcProfile_company_city_id").val(city_id).change();
                }
            } else {
                // Не найден адрес
                $("#CcProfile_company_full_addres").val("");
                $("#company_country").val("");
                country_id = undefined;
                $("#CcProfile_company_country_id").val(country_id);
                $("#company_city").val("");
                city_id = undefined;
                $("#CcProfile_company_city_id").val(city_id).change();
                $(".aL").remove();
            }
        },
        type:'GET',
        dataType:'json',
        async:true
    });
}

function setGeoValue(latLng,model){
    $("#"+model+"_longitude").val(latLng.lng);
    $("#"+model+"_latitude").val(latLng.lat);
}

function moveMarker(mapData){
    mapData.map.panTo(mapData.marker.getPosition());
    if(mapData.map.getZoom()<6){
        mapData.map.setZoom(11);
    }
}
function delRow(o){
    var $o = $(o);
    $.fn.yiiactiveform.removeFields($o.parents('form'),$o.parent().parent().find("input, select"));
    $o.parent().parent().remove();
}
function delRowMap(o){
    var $o = $(o);
    $.fn.yiiactiveform.removeFields($o.parents('form'),$o.parent().parent().find("input, select"));
    // Удаляем карты
    var mapId = $o.parent().parent().attr("class").split(" ")[2];
    $.each(map,function(i){
        if(this.id==mapId){
            delete map[i];
            return false;
        }
    });
    $o.parent().parent().remove();
}
/** **/
function emptyObject(obj) {
    for (var i in obj) {
        return false;
    }
    return true;
}
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (searchElement /*, fromIndex */ ) {
        'use strict';
        if (this == null) {
            throw new TypeError();
        }
        var n, k, t = Object(this),
            len = t.length >>> 0;

        if (len === 0) {
            return -1;
        }
        n = 0;
        if (arguments.length > 1) {
            n = Number(arguments[1]);
            if (n != n) { // shortcut for verifying if it's NaN
                n = 0;
            } else if (n != 0 && n != Infinity && n != -Infinity) {
                n = (n > 0 || -1) * Math.floor(Math.abs(n));
            }
        }
        if (n >= len) {
            return -1;
        }
        for (k = n >= 0 ? n : Math.max(len - Math.abs(n), 0); k < len; k++) {
            if (k in t && t[k] === searchElement) {
                return k;
            }
        }
        return -1;
    };
}