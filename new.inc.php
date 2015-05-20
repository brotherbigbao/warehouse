<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if(!$_G['uid']) {
    showmessage('请先登录！', '', array(), array('login' => true));
}

//REQUIRE
require_once 'source/plugin/warehouse/warehouse_help.class.php';
require_once 'source/function/function_home.php';

//CHECK COMPANY INFO
$company = C::t('#warehouse#common_plugin_warehouse_company')->fetch($_G['uid']);
$companyname = trim($company['companyname']);
if($companyname == ''){
    showmessage('请先完善企业信息！', 'plugin.php?id=warehouse:company');
}

//ASSIGN
$warehouse_type = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_type']);
$warehouse_floor = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_floor']);
$warehouse_status = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_status']);
$warehouse_business = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_business']);

$lng_input = $_G['cache']['plugin']['warehouse']['lng_input'];
$lat_input = $_G['cache']['plugin']['warehouse']['lat_input'];
$zoom_input = $_G['cache']['plugin']['warehouse']['zoom_input'];
$location_input = $_G['cache']['plugin']['warehouse']['location_input'];

//GET
$warehouseid = intval($_GET['warehouseid']);
if($warehouseid){
    $house = C::t('#warehouse#common_plugin_warehouse')->fetch($warehouseid);
    if($house['companyid'] != $_G['uid']){
        showmessage("操作出现错误！");
    }
    $sels = array();
    $sels['type'][$house['type']] = ' selected="selected"';
    $sels['floor'][$house['floor']] = ' selected="selected"';
    $sels['status'][$house['status']] = ' selected="selected"';
    $sels_business = explode(',', $house['business']);
    foreach($sels_business as $key=>$val){
        $sels['business'][$val] = ' checked="checked"';
    }
    $images = C::t('#warehouse#common_plugin_warehouse_image')->fetch_all_by_warehouseid($warehouseid);
}

//POST
if(submitcheck("housesubmit")){
    $warehouseid = intval($_POST['house']['warehouseid']);
    unset($_POST['house']['warehouseid']);
    $_POST['house']['updatetime'] = time();
    $_POST['house']['business'] = implode(',', $_POST['house']['business']);
    $_POST['house']['companyid'] = $_G['uid'];
    $_POST['house']['companyname'] = $companyname;
    if($warehouseid){
        $target = C::t('#warehouse#common_plugin_warehouse')->fetch($warehouseid);
        if($target['companyid'] != $_G['uid']){
            showmessage("操作出现错误！");
        }
        $res = C::t('#warehouse#common_plugin_warehouse')->update($warehouseid, $_POST['house']);
    }else{
        $_POST['house']['addtime'] = time();
        $res = C::t('#warehouse#common_plugin_warehouse')->insert($_POST['house'], true);
        $warehouseid = $res;
    }
    $IMAGE = warehouse_help::reArrayFiles($_FILES['houseimage']);
    foreach($IMAGE as $img){
        $pic_res = pic_upload($img, 'category', '200', '140');
        if($pic_res['pic'] && $pic_res['thumb']){
            C::t('#warehouse#common_plugin_warehouse_image')->insert(array("warehouseid"=>$warehouseid, "imageurl"=>$pic_res['pic']));
        }
    }
    showmessage("成功发布！", "plugin.php?id=warehouse:list");
}

include template('warehouse:new');