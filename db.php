<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 20/08/16
 * Time: 01:26
 */

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

require ('connect.php');

// DB CHECK /////////////////////////////////////////
$sql = "SELECT id, ign, server FROM summoners";
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}

$data = $result->fetch_assoc();
$conn->close();


var_dump($data);


?>