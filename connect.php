<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 20/08/16
 * Time: 00:06
 */

$servername = "mysql.hostinger.co.uk";
$username = "u309149150_rigi";
$password = "Chynorany1";
$database = "u309149150_rito";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
//echo nl2br("\n");

?>