<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']) {
    exit();
}
require_once 'source/plugin/warehouse/json.class.php';
require_once 'source/function/function_home.php';

header('Content-type: application/json');

if($_GET['type'] == 'del_warehouse'){
    $data = array('status'=>0);
    $warehouseid = intval($_GET['warehouseid']);
    $warehouse = C::t('#warehouse#common_plugin_warehouse')->fetch($warehouseid);
    if($warehouse['companyid'] == $_G['uid']){
        $res = C::t('#warehouse#common_plugin_warehouse')->delete($warehouseid);
        if($res){
            $data = array('status'=>1);
        }
    }
    echo CJSON::encode($data);
}

if($_GET['type'] == 'del_image'){
    $data = array('status'=>0);
    $imageid = intval($_GET['imageid']);
    $image= C::t('#warehouse#common_plugin_warehouse_image')->fetch($imageid);
    if($image){
        $warehouse = C::t('#warehouse#common_plugin_warehouse')->fetch($image['warehouseid']);
        if($warehouse['companyid'] == $_G['uid']){
            pic_delete($image['imageurl'], 'category', 1, 0);
            $res = C::t('#warehouse#common_plugin_warehouse_image')->delete($imageid);
            if($res){
                $data = array('status'=>1);
            }
        }
    }
    echo CJSON::encode($data);
}