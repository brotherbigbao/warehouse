<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once 'source/plugin/warehouse/warehouse_help.class.php';

if(!intval($_GET['warehouseid'])){
        showmessage("²Ù×÷Ê§°Ü£¡");
}
$warehouseid = intval($_GET['warehouseid']);
$warehouse = C::t('#warehouse#common_plugin_warehouse')->fetch($warehouseid);
$company = C::t('#warehouse#common_plugin_warehouse_company')->fetch($warehouse['companyid']);
$warehouse_list = C::t('#warehouse#common_plugin_warehouse')->fetch_all_by_companyid($warehouse['companyid']);

$images = C::t('#warehouse#common_plugin_warehouse_image')->fetch_all_by_warehouseid($warehouseid);

$type = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_type']);
$status = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_status']);
$floor = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_floor']);
$business = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_business']);

include template('warehouse:show');

function business_display($str, $business){
    $array = explode(',', $str);
    $string = '';
    foreach($array as $val){
        $string .= $business[$val]."&nbsp;";
    }
    return $string;
}

