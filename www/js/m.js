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