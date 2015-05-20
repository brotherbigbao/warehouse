<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_common_plugin_warehouse extends discuz_table {
        public function __construct() {
		$this->_table = 'common_plugin_warehouse';
		$this->_pk = 'warehouseid';

		parent::__construct();
	}
        
        public function fetch_all_by_companyid($companyid){
                $data = array();
                $query = DB::query('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field('companyid', $companyid).' ORDER BY '.$this->_pk.' DESC ');
                while($value = DB::fetch($query)) {
                        $data[] = $value;
                }
                return $data;                
        }
}