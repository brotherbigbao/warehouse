<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']) {
    showmessage('ÇëÏÈµÇÂ¼£¡', '', array(), array('login' => true));
}

$warehouse_list = C::t('#warehouse#common_plugin_warehouse')->fetch_all_by_companyid($_G['uid']);

include template('warehouse:list');