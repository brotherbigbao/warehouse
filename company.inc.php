<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']) {
    showmessage('ÇëÏÈµÇÂ¼£¡', '', array(), array('login' => true));
}

$company = C::t('#warehouse#common_plugin_warehouse_company')->fetch($_G['uid']);

if(submitcheck('companysubmit')){
    $_POST['company']['updatetime'] = time();
    if($company){
        C::t('#warehouse#common_plugin_warehouse_company')->update($_G['uid'], $_POST['company']);
    }else{
        $_POST['company']['companyid'] = $_G['uid'];
        C::t('#warehouse#common_plugin_warehouse_company')->insert($_POST['company']);
    }
    $company = C::t('#warehouse#common_plugin_warehouse_company')->fetch($_G['uid']);
}

include template('warehouse:company');

