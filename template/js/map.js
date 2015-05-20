
//init
var map = new BMap.Map("map", {"enableMapClick":false});
map.setMaxZoom(19);
var point = new BMap.Point(116.400819,39.928437);
map.centerAndZoom(point, 11);
map.enableScrollWheelZoom();
map.addControl(new BMap.ScaleControl());
map.addControl(new BMap.NavigationControl());
map.addControl(new BMap.MapTypeControl());

//addevent
map.addEventListener("dragend", function(){
    if(Timer != null) clearTimeout(Timer);
    Timer = setTimeout('refreshMap()',1000); 
}); 
map.addEventListener("zoomend", function(){     
    if(Timer != null) clearTimeout(Timer);
    Timer = setTimeout('refreshMap()',1000);
});

//default position
if(lng_display && lat_display){
    var point = new BMap.Point(lng_display,lat_display);
    if(zoom_display){
        map.centerAndZoom(point,zoom_display); 
    }else{
        map.centerAndZoom(point);
    }  
}else{
    var myCity = new BMap.LocalCity();
    myCity.get(function(result){
        var cityName = result.name;
        map.setCenter(cityName);
    });   
}
function myFun(result){
    var cityName = result.name;
    map.setCenter(cityName);
    alert(cityName);
}

//global
var Timer = null;
var MarkerIndex = 1;
var BlueIcon = new BMap.Icon(marker_icon_blue, new BMap.Size(26, 37), {
        anchor: new BMap.Size(13, 37)
}); 

//core function
function refreshMap(){
    jQuery(".loader").show();
    var type = jQuery("#op_check .warehouse_type").attr("data-id");
    var status = jQuery("#op_check .warehouse_status").attr("data-id");
    var area_min = jQuery("#op_check .warehouse_area").attr("data-min");
    var area_max = jQuery("#op_check .warehouse_area").attr("data-max");
    var keyword = jQuery("#op_check .warehouse_keyword").attr("data-keyword");
    
    var bounds = map.getBounds();
    var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();
    
    
    
    var url = '';
    if(type) { url = url+"&type="+type; }
    if(status) { url = url+"&status="+status; }
    if(area_min && area_max) { url = url+"&area_min="+area_min+"&area_max="+area_max; }
    if(keyword) { url = url+"&keyword="+keyword; }
    if(sw && ne) { url += "&lng_min="+sw.lng+ "&lng_max="+ne.lng+"&lat_min="+sw.lat+"&lat_max="+ne.lat; }
    jQuery.getJSON('plugin.php?id=warehouse:mapserver'+url, function(data){
            if(data.status == '1')
            {
                addMarker(data.list);
                setCount(data.count);
                jQuery(".loader").hide();
            }else{
                jQuery(".loader").hide();
            }
    });
}
function addMarker(list, movemap){
    map.clearOverlays();
    var ul = jQuery("#warehouse_list");
    ul.empty();
    var i=0;
    jQuery.each(list, function(index, warehouse){
        
        var myIcon = new BMap.Icon(marker_icon_url, new BMap.Size(23, 25), {//addmarker
            anchor: new BMap.Size(10, 25),
            imageOffset: new BMap.Size(0, 0 - i * 25)
        });
        var point = new BMap.Point(warehouse.lng, warehouse.lat);
        var marker = new BMap.Marker(point, {icon:myIcon});
        map.addOverlay(marker);
        
        var dl = jQuery("<dl class='markerinfo'></dl>");//add infowindow
        var dt = jQuery("<dt><a href='javascript:void(0);'>"+warehouse.name+"</a></dt>");
        var dd_str = '';
        dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>类型："+json_type[warehouse.type]+"</a></dd>";
        dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>状态："+json_status[warehouse.status]+"</a></dd>";
        dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>地面："+json_floor[warehouse.floor]+"</a></dd>";
        dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>面积："+warehouse.area+"平米</a></dd>";
        dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>业务："+businessDisplay(warehouse.business)+"</a></dd>";
        dd_str += "<dd class='more'><a href='plugin.php?id=warehouse:show&warehouseid="+warehouse.warehouseid+"' target='_blank'>详细...</a></dd>";
        var dd = jQuery(dd_str);
        dl.append(dt);
        dl.append(dd);
        dl = dl[0];
        var opts = {"message":warehouse.name};//bind message window
        var infoWindow = new BMap.InfoWindow(dl,opts);
        marker.addEventListener("click", function(){          
           this.openInfoWindow(infoWindow);
           radius();
        });
        
        var list_li = jQuery("<li></li>");//addlist
        var list_dl = jQuery("<dl></dl>");
        var list_dt = jQuery("<dt><a href='plugin.php?id=warehouse:show&warehouseid="+warehouse.warehouseid+"' target='_blank'>"+warehouse.name+"</a></dt>");
        var list_dd_str = '';
        list_dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>类型："+json_type[warehouse.type]+"</a></dd>";
        list_dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>状态："+json_status[warehouse.status]+"</a></dd>";
        list_dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>地面："+json_floor[warehouse.floor]+"</a></dd>";
        list_dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>面积："+warehouse.area+"平米</a></dd>";
        list_dd_str += "<dd><i class='icon job'></i><a href='javascript:void(0)'>业务："+businessDisplay(warehouse.business)+"</a></dd>";
        var list_dd = jQuery(list_dd_str);
        list_dl.append(list_dt);
        list_dl.append(list_dd);
        list_li.append("<i class='marker marker"+(i+1)+"'></i>");
        list_li.append(list_dl);
        ul.append(list_li);    
        
        marker.addEventListener("mouseover", function(event){//add event
           list_li.css("background-color", "#fff");
        });
        marker.addEventListener("mouseout", function(){          
           list_li.css("background-color", "#f8f8f8");
        });
        list_li.click(function(event){
            if(event.target.tagName != 'a' && event.target.tagName != 'A'){
                marker.openInfoWindow(infoWindow);
                radius();
            }
        });
        list_li.hover(
            function(event){
                marker.setIcon(BlueIcon);
                marker.setZIndex(MarkerIndex++);
                list_li.css("background-color", "#fff");
            },
            function(event){
                marker.setIcon(myIcon);
                list_li.css("background-color", "#f8f8f8");
            }
        );
        i++;
    }); 
}
function setCount(count){
    jQuery("#count").html(count);
}
function radius(){
    jQuery(".BMap_top").next().children().css('border-top-right-radius', '10px 10px');
    jQuery(".BMap_top").prev().children().css('border-top-left-radius', '10px 10px');
    jQuery(".BMap_bottom").next().children().css('border-bottom-right-radius', '10px 10px');
    jQuery(".BMap_bottom").prev().children().css('border-bottom-left-radius', '10px 10px');    
}
function businessDisplay(business){
    var array = business.split(',');
    var string = '';
    for(var i=0; i<array.length; i++){
        string += json_business[array[i]]+"&nbsp;";
    }
    return string;
}

jQuery(document).ready(function($){
    //搜索条件
    $(".option a.warehouse_type").click(function(){
        if($("#op_check .warehouse_type").length>0){
            $("#op_check .warehouse_type").remove();
        }
        $(this).clone().attr({"title":"删除"}).appendTo("#op_check");
        refreshMap();
    });
    $(".option a.warehouse_status").click(function(){
        if($("#op_check .warehouse_status").length>0){
            $("#op_check .warehouse_status").remove();
        }
        $(this).clone().attr({"title":"删除"}).appendTo("#op_check");
        refreshMap();
    });
    $("#warehouse_search").click(function(){
        area_keyword();
        refreshMap();
    });
    $("#warehouse_area_min,#warehouse_area_max,#warehouse_keyword").keydown(function(event){
        if(event.keyCode==13){
            area_keyword();
            refreshMap();
        }
    });
    $("#op_check").on("click",function(event){
        if($(event.target).is("a")){
            $(event.target).remove();
            refreshMap();
        }
    });
    function area_keyword(){
        var area_min = parseInt($.trim($("#warehouse_area_min").val()));
        var area_max = parseInt($.trim($("#warehouse_area_max").val()));
        var keyword = $("#warehouse_keyword").val();
        if(area_min && area_max){
            if($("#op_check .warehouse_area").length>0){
                $("#op_check .warehouse_area").remove();
            }
            $("<a href=\"javascript:void(0)\" data-min=\""+area_min+"\" data-max=\""+area_max+"\" class=\"warehouse_area\" title=\"删除\">面积："+area_min+"-"+area_max+"</a>").appendTo("#op_check");
        }
        if(keyword){
            if($("#op_check .warehouse_keyword").length>0){
                $("#op_check .warehouse_keyword").remove();
            }
            $("<a href=\"javascript:void(0)\" data-keyword=\""+keyword+"\" class=\"warehouse_keyword\" title=\"删除\">关键字："+keyword+"</a>").appendTo("#op_check");            
        }        
    }
});
