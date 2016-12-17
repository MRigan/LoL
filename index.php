<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 15/08/16
 * Time: 21:26
 */

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

require ('connect.php');
require ('vars.php');

$url5 = $global_server.'/'.$api_lol.'/'.$function5.'/'.$Region.'/'.$version12.'/champion?'.$API_key;
//echo $url5;


$json = file_get_contents($url5);
$obj = json_decode($json);
 
$data = $obj->data;

foreach ($data as $champion){
    //print_r($champion);

    $id = $champion->id;
    $name_data = $champion->name;
    $name = str_replace("'", "''", $name_data );
    $title_data = $champion->title;
    $title = str_replace("'", "''", $title_data );
    
    
    // mysqli insert
    $sql = "INSERT INTO champions (id, name, title) VALUES ( '$id', '$name', '$title' )";
    //echo $sql;
    
    
    if (!$result = $conn->query($sql)) {
        echo "Sorry, the website is experiencing problems.";

        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $conn->errno . "\n";
        echo "Error: " . $conn->error . "\n";
        exit;
    }
    
    
    echo 'done: '.$name;
    echo nl2br("\n");
//$data = $result->fetch_assoc();
}

$conn->close();

?>