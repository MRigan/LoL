<?php
// stores tier, league, league name, points, wins and loses
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 21/08/16
 * Time: 03:37
 */

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

require ('connect.php');
require ('vars.php');

?>
<html>
<head>
    <title>RIOT API designed by Rigino</title>
    <meta charset=\"utf-8\">
    <link href="css/style2.css" rel='stylesheet' type='text/css' />
</head>
<body background="/images/bg.jpg">

<?php
// FUNCTION 3

$summoner_get = $_GET['summoner'];
$summoner = ''.$summoner_get.'';

// DB CHECK /////////////////////////////////////////
$sql = "SELECT id FROM summoners WHERE ign = '$summoner'";
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}

$data = $result->fetch_assoc();

if (empty($data)){
    ?>
<div>
    <font color="white">
        <center>
            <?php
    echo 'You are NOT in the DB yet!!!';
    echo nl2br("\n");
    echo 'Go "<a href="id.html" style="color: gold">HERE</a>" to add yourself to DB first :)';
            ?>
        </center>
        </font>
</div>
<?php
}
else {
//$conn->close();

//var_dump($data);
    echo nl2br("\n");
    $id = $data['id'];
    echo 'Your ID is: ' . $id;
    echo nl2br("\n");


    $function3 = 'league/by-summoner';
    $url3 = $europe_server . '/' . $api_lol . '/' . $Region . '/' . $version25 . '/' . $function3 . '/' . $id . '?' . $API_key;


    $json3 = file_get_contents($url3);
    $obj3 = json_decode($json3);


    $var = $obj3->$id;
    $var2 = $var[0];
    $TIER = $var2->tier;
    $NAME = $var2->name;

    $var3 = $var2->entries;
    /*
    echo "<pre>";
    var_dump($var3);
    echo "</pre>";
    */

    $size = sizeof($var3);
    $i = 0;
    while ($i < $size) {
        $var4 = $var3[$i];
        //var_dump($var4);
        $var5 = $var4->playerOrTeamId;
        if ($var5 == "$id") {
            $division = $var4->division;
            $leaguePoints = $var4->leaguePoints;
            $wins = $var4->wins;
            $losses = $var4->losses;
        }
        $i++;
    }

    //view
?>

<div>
    <font color="white">
        <center>
    
    <?php
    echo 'Your Tier is: ' . $TIER;
    echo nl2br("\n");
    echo 'Your League name is: ' . $NAME;
    echo nl2br("\n");
    echo 'Your division is: ' . $division;
    echo nl2br("\n");
    echo 'You currently have ' . $leaguePoints . ' points';
    echo nl2br("\n");
    echo 'Number of wins: ' . $wins;
    echo nl2br("\n");
    echo 'Number of losses: ' . $losses;
    ?>

        </center>
    </font>
</div></body>

<?php
//insert into db
    //check if exists
    $sql = "SELECT * FROM rank where id = ".$id;
    if (!$result = $conn->query($sql)) {
        echo "Sorry, the website is experiencing problems.";

        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $conn->errno . "\n";
        echo "Error: " . $conn->error . "\n";
        exit;
    }
    $exist = $result->fetch_assoc();
    
    // if exists, update everything except for ID
    if (!empty($exist)){
        $league_name = mysqli_real_escape_string($conn, $NAME);

        $sql = "UPDATE rank SET tier = '$TIER', division = '$division', league_name = '$league_name', lp = ".$leaguePoints.", wins = ".$wins.", losses = ".$losses." WHERE id = ".$id;
        if (!$result = $conn->query($sql)) {
            echo "Sorry, the website is experiencing problems.";

            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $conn->errno . "\n";
            echo "Error: " . $conn->error . "\n";
            exit;
        }
        $conn->close();

        echo nl2br("\n");
        echo nl2br("\n");
        echo '<font color="white"><center>Successfully updated!!!</center></font>';
    }
    else {

        $league_name = mysqli_real_escape_string($conn, $NAME);

        $sql = "INSERT INTO rank (id, tier, division, league_name, lp, wins, losses) VALUES (" . $id . ", '$TIER', '$division', '$league_name', " . $leaguePoints . ", " . $wins . ", " . $losses . ")";
        if (!$result = $conn->query($sql)) {
            echo "Sorry, the website is experiencing problems.";

            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $conn->errno . "\n";
            echo "Error: " . $conn->error . "\n";
            exit;
        }
        $conn->close();

        echo nl2br("\n");
        echo nl2br("\n");
        echo '<font color="white"><center>Successfully inserted into DB!!!</center></font>';
    }
}

?>
