<?php

if(!function_exists('separateString')){
    /**
     * 文字列指定位置分割関数
     *
     * 文字列の $position 文字目にスペースを入れる
     *
     * @param $string
     * @param $position
     * @return string
     */
    function separateString($string, $position){
        $last = mb_substr($string,$position);
        $first = mb_substr($string,0,$position);
        return $first." ".$last;
    }
}

if(!function_exists('convertDateString')){
    /**
     * 日付変換関数
     *
     * @param $date
     * @param $type
     * @return bool|false|string
     */
    function convertDateString($date, $type){
        switch ($type){
            case 'slash':
                return date('n/j',strtotime($date));
            case 'ja':
                return date('n月j日',strtotime($date));
            case 'ja_year':
                return date('Y年n月j日',strtotime($date));
            default:
                return false;
        }
    }
}

if(!function_exists('getTypeColor')){
    /**
     * 属性色呼び出し関数
     *
     * @param $type
     * @return string
     */
    function getTypeColor($type){
        $type = strtolower($type);
        switch ($type){
            case "fairy":
                return "#005eff";
            case "princess":
                return "#ff2284";
            case "angel":
                return "#ffbb00";
            default:
                return "#00ff43";
        }
    }
}