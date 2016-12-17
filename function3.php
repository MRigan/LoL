<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 31/08/16
 * Time: 20:21
 */



// FUNCTION 3

$function3 = 'league/by-summoner';
$url3 =  $europe_server.'/'.$api_lol.'/'.$Region.'/'.$version25.'/'.$function3.'/'.$id.'?'.$API_key;

$json3 = file_get_contents($url3);
$obj3 = json_decode($json3);
//var_dump($obj3);

?>