<?php
if (!function_exists('googleMaps')) {
    function googleMaps($url)
    {
        if(preg_match('~@(.*?)z~', $url, $output)){

            $params=explode(',',$output[1]);
            if(count($params)){
                return 'https://maps.google.com/maps?q='.$params[0].','.$params[1].'&hl=es;z='.$params[2].'&output=embed';
            }

        }
        return null;

    }
}