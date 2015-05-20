<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_common_plugin_warehouse_company extends discuz_table {
        public function __construct() {
		$this->_table = 'common_plugin_warehouse_company';
		$this->_pk = 'companyid';

		parent::__construct();
	}
}