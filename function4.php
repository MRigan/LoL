<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 31/08/16
 * Time: 20:44
 */

// FUNCTION 4
$url4 = $europe_server.'/'.$function4.'/location/'.$platform1.'/player/'.$myID.'/score?'.$API_key;
//echo $url4;


$json = file_get_contents($url4);
$obj = json_decode($json);
var_dump($obj);

?>