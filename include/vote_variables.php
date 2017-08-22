<?php
include ("db_conn.php");

$max_votes = 5;
$high_votes = 50;
$low_votes = -30;

//varriables are set to defaults
$votes_today = 0;
$current_date = date("Y-m-d");
$votes_expiry = "0000-00-00";

if (isset($_SESSION["username"])){
$user = $link->real_escape_string($_SESSION["username"]);

//prepare the statement so that its ready to interact with database
$sel_user = $link->prepare("SELECT votes_today, votes_expiry FROM users WHERE username=?");

//set the parameters
$sel_user->bind_param("s", $user);

//execute the query
$sel_user->execute();

$sel_user->bind_result($votes_today, $votes_expiry);

$sel_user->store_result();

$sel_user->fetch();
}


?>