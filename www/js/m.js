/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.12.13
 * @time 10:08
 * Created by JetBrains PhpStorm.
 */
var autoFind = false;
var hideSearchResult = false;
var currentObj;
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