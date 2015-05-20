<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once 'source/plugin/warehouse/warehouse_help.class.php';
require_once 'source/plugin/warehouse/json.class.php';

$location_display = $_G['cache']['plugin']['warehouse']['location_display'];
$lng_display = $_G['cache']['plugin']['warehouse']['lng_display'];
$lat_display = $_G['cache']['plugin']['warehouse']['lat_display'];
$zoom_display = $_G['cache']['plugin']['warehouse']['zoom_display'];
$warehouse_type = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_type']);
$warehouse_status = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_status']);

$warehouse_floor = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_floor']);
$warehouse_business = warehouse_help::explode($_G['cache']['plugin']['warehouse']['warehouse_business']);

$json_type = CJSON::encode($warehouse_type);
$json_status = CJSON::encode($warehouse_status);
$json_floor = CJSON::encode($warehouse_floor);
$json_business = CJSON::encode($warehouse_business);

include template('warehouse:map');

