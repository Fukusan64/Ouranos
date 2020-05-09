<?php

if(!function_exists('changeGetParameter')){
    /**
     * GETパラメータをいじるやつ $valueがnullならパラメータごと除去
     *
     * @param string $url
     * @param string $attribute
     * @param string|null $value
     * @return string|string[]|null
     */
    function changeGetParameter(string $url, string $attribute, string $value = null){
        $url = preg_replace('/&?'.$attribute.'=[^&]+/i','',$url);
        if(!empty($value)){
            if(mb_strpos($url,'?') === false) $url .= '?'.$attribute.'='.$value;
            else $url .= '&'.$attribute.'='.$value;
        }
        $url = str_replace('?&','?',$url);
        $url = preg_replace('/\?$/','',$url);

        return $url;
    }
}
