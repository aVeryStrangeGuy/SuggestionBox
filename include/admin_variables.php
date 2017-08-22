<?php
include ("db_conn.php");

//varriables are set to defaults
$admin_check = 0;

if (isset($_SESSION["username"])){
$user = $link->real_escape_string($_SESSION["username"]);

//prepare the statement so that its ready to interact with database
$sel_user = $link->prepare("SELECT admin FROM users WHERE username=?");

//set the parameters
$sel_user->bind_param("s", $user);

//execute the query
$sel_user->execute();

$sel_user->bind_result($admin_check);

$sel_user->store_result();

$sel_user->fetch();
}