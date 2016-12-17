<?php
require ('connect.php');

$sql = "SELECT s.ign AS name, s.server, r.tier, r.division, r.lp, r.wins, r.losses
FROM  `summoners` s
INNER JOIN  `rank` r ON s.id = r.id";
if (!$result = $conn->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
};
//var_dump($data);

?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Summoners</title>
    <link rel="stylesheet" href="css/table.css">
</head>

<body>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Table Style</title>
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>

<body>
<div class="table-title">
    <h3>Data Table</h3>
</div>
<table class="table-fill">
    <thead>
    <tr>
        <th class="text-left">Summoner name</th>
        <th class="text-left">Region</th>
        <th class="text-left">Tier</th>
        <th class="text-left">Division</th>
        <th class="text-left">LP</th>
        <th class="text-left">Wins</th>
        <th class="text-left">Losses</th>

    </tr>
    </thead>
    <tbody class="table-hover">

    <?php
    foreach ($data as $row) {
        echo '
<tr>
<td class="text-left">' . $row['name'] . '</td>
<td class="text-left">' . $row['server'] . '</td>
<td class="text-left">' . $row['tier'] . '</td>
<td class="text-left">' . $row['division'] . '</td>
<td class="text-left">' . $row['lp'] . '</td>
<td class="text-left">' . $row['wins'] . '</td>
<td class="text-left">' . $row['losses'] . '</td>
</tr>';
    }
    ?>

    </tbody>
</table>

</body>
</html>