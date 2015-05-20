<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once 'source/plugin/warehouse/json.class.php';

header('Content-type: application/json');

$condition = " WHERE 1 ";
if(isset($_GET['type'])){
    $type = intval($_GET['type']);
    if($type){
        $condition .= " AND `type`=".$type;
    }
}
if(isset($_GET['status'])){
    $status = intval($_GET['status']);
    if($status){
        $condition .= " AND `status`=".$status;
    }
}
if(isset($_GET['area_min']) && isset($_GET['area_max'])){
    $area_min = intval($_GET['area_min']);
    $area_max = intval($_GET['area_max']);
    if($area_min && $area_max){
        $condition .= " AND `area`>=".$area_min." AND `area`<=".$area_max;
    }
}
if(is_numeric($_GET['lng_min']) && is_numeric($_GET['lng_max']) && is_numeric($_GET['lat_min']) && is_numeric($_GET['lat_max']) ){
    $condition .= " AND `lng`>='".$_GET['lng_min']."' AND `lng`<='".$_GET['lng_max']."' AND `lat`>='".$_GET['lat_min']."' AND `lat`<='".$_GET['lat_max']."'";
}
if(isset($_GET['keyword'])){
    $keyword = daddslashes(trim($_GET['keyword']));
    if($keyword){
        $condition .= " AND (`name` LIKE '%".$keyword."%' OR `companyname` LIKE '%".$keyword."%')";
    }
}

$query_count = DB::query('SELECT count(*) AS count FROM '.DB::table('common_plugin_warehouse').$condition);
$row_count = DB::fetch($query_count);
$warehouse_count = $row_count['count'];
$query = DB::query('SELECT `warehouseid`,`companyid`,`name`,`companyname`,`type`,`status`,`floor`,`business`,`area`,`high`,`address`,`lng`,`lat` FROM '.DB::table('common_plugin_warehouse').$condition);
$warehouse_list = array();
while($value = DB::fetch($query)) {
    $warehouse_list[] = $value;
}
$data = array(
    'status' => 1,
    'list' => $warehouse_list,
    'count' => $warehouse_count,
);
echo CJSON::encode($data);