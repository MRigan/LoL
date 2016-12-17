<?php
require ('connect.php');

$sql = "SELECT * FROM champions order by id asc";
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
    <title>Champions</title>
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
        <th class="text-left">ID</th>
        <th class="text-left">Name</th>
        <th class="text-left">Title</th>
    </tr>
    </thead>
    <tbody class="table-hover">

    <?php
    foreach ($data as $row) {
        echo '
<tr>
<td class="text-left">' . $row['id'] . '</td>
<td class="text-left">' . $row['name'] . '</td>
<td class="text-left">' . $row['title'] . '</td>
</tr>';
    }
    ?>

    </tbody>
</table>

</body>
</html>