<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_common_plugin_warehouse_image extends discuz_table {
        public function __construct() {
		$this->_table = 'common_plugin_warehouse_image';
		$this->_pk = 'imageid';

		parent::__construct();
	}
        public function fetch_all_by_warehouseid($warehouseid){
                $data = array();
                $query = DB::query('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field('warehouseid', $warehouseid));
                while($value = DB::fetch($query)) {
                        $data[] = $value;
                }
                return $data;
        }
}