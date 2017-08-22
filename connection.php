<?php
// This will need to be changed to cmatch your own database
$link = mysqli_connect("localhost", "TEST", "TEST", "suggestion");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT * FROM  suggestion WHERE suggestion_visable = 1  ORDER BY sugestion_num ASC";

$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo $row['suggestion_type'];
    echo "<br/>";
}

?>
