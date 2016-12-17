<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 31/08/16
 * Time: 20:20
 */


// FUNCTION 2

$function2 = 'game/by-summoner';
$url2 = $europe_server.'/'.$api_lol.'/'.$Region.'/'.$version13.'/'.$function2.'/'.$id.'/recent/?'.$API_key;
echo $url2;

$json2 = file_get_contents($url2);
$obj2 = json_decode($json2);
var_dump($obj2);

?>