<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 31/08/16
 * Time: 20:20
 */

// FUNCTION 1
$summoner = 'Forgotten Knight';
$url = $europe_server.'/'.$api_lol.'/'.$Region.'/'.$version14.'/'.$function.'/'.$summoner.'?'.$API_key;
$json = file_get_contents($url);
$obj = json_decode($json);
var_dump($obj);


//get vars
$var = strtolower($summoner);
//echo $obj->$var->summonerLevel;
$id = $obj->$var->id;
//$id_string = (string)$id;

$ign = $obj->$var->name;
//$ign_string = (string)$ign;


// mysqli insert
$sql = "INSERT INTO summoners (id, ign, server) VALUES ( '$id', '$ign', '$Region')";
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}

//$data = $result->fetch_assoc();
$conn->close();


?>