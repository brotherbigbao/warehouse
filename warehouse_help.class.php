<?php

class warehouse_help{
    public static function explode($str){
        $data = array_filter(explode(',', $str));
        $res = array();
        foreach($data as $row){
            list($index,$value) = explode('=', $row);
            $index = trim($index);
            $value = trim($value);
            $res[$index] = $value;
        }
        return $res;
    }
    public static function reArrayFiles($file_post) {
        $keys = array_keys($file_post);
        $new = array();
        $j = 0;
        for($i=0; $i<count($file_post['name']); $i++){
            if($file_post['name'][$i] == ''){
                continue;
            }
            foreach($keys as $key){
                $new[$j][$key] = $file_post[$key][$i];
            }
            $j++;
        }
       return $new;
    }
}

