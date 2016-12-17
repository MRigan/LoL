<?php
// stores id, ign and region into db upon receiving summoner name from api

/**
 * Created by PhpStorm.
 * User: michal
 * Date: 21/08/16
 * Time: 01:34
 */

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

require ('connect.php');
require ('vars.php');


// FUNCTION 1
$summoner_get = $_GET['summoner'];
$summoner = str_replace(' ', '%20', $summoner_get);
$url = $europe_server.'/'.$api_lol.'/'.$Region.'/'.$version14.'/'.$function.'/'.$summoner.'?'.$API_key;

//echo $url;
//echo nl2br("\n");


$json = @file_get_contents($url);
$obj = json_decode($json);
//var_dump($obj);

if (empty($obj)){
    echo 'Something went wrong buddy :/ ...';
?>
    <html>
    <head>
        <title>RIOT API designed by Rigino</title>
        <meta charset=\"utf-8\">
        <link href="css/cool.css" rel='stylesheet' type='text/css' />
    </head>
    <body>
    <div></div>
    </body>
    </html>
<?php
}
else {

    $var = strtolower(str_replace(' ', '', $summoner_get));
//echo $obj->$var->summonerLevel;
    $id = $obj->$var->id;
//$id_string = (string)$id;

    $ign = $obj->$var->name;
//$ign_string = (string)$ign;
    
    
    //check if exist
$sql = "SELECT * FROM summoners WHERE id = ".$id;
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}
$data = $result->fetch_assoc();
    
if (!empty($data)){ ?>
    <html>
<head>
    <title>RIOT API designed b//$data = $result->fetch_assoc();y Rigino</title>
    <meta charset=\"utf-8\">
    <link href="css/style2.css" rel='stylesheet' type='text/css' />
</head>
<body background="/images/bg.jpg">
<div>
    <font color="white">
        <center>
            <?php
            echo 'You already exist in the DB :)';
            ?>
        </center>
    </font>
</div>
</body>
</html>
    <?php
}    
    
    else {

        $sql = "INSERT INTO summoners (id, ign, server) VALUES ( '$id', '$ign', '$Region')";
        if (!$result = $conn->query($sql)) {
            echo "Sorry, the website is experiencing problems.";

            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $conn->errno . "\n";
            echo "Error: " . $conn->error . "\n";
            exit;
        } else {
            ?>
            <html>
            <head>
                <title>RIOT API designed b//$data = $result->fetch_assoc();y Rigino</title>
                <meta charset=\"utf-8\">
                <link href="css/style2.css" rel='stylesheet' type='text/css'/>
            </head>
            <body background="/images/bg.jpg">
            <div>
                <font color="white">
                    <center>
                        <?php
                        echo 'Successfully added to DB!!! :)';
                        ?>
                    </center>
                </font>
            </div>
            </body>
            </html>
            <?php
        }
    }

//$data = $result->fetch_assoc();
    $conn->close();
}
?>
