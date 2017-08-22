<?php
include ("db_conn.php");

$max_suggestions = 1;

//varriables are set to defaults
$suggestions_today = 0;
$suggestions_expiry = "0001-00-00";
$current_date = date("Y-m-d");

if (isset($_SESSION["username"])){
	$user = $link->real_escape_string($_SESSION["username"]);

	//prepare the statement so that its ready to interact with database
	$sel_user = $link->prepare("SELECT suggestions_today, suggestions_expiry FROM users WHERE username=?");

	//set the parameters
	$sel_user->bind_param("s", $user);

	//execute the query
	$sel_user->execute();

	$sel_user->bind_result($suggestions_today, $suggestions_expiry);

	$sel_user->store_result();

	$sel_user->fetch();


	//prepare the statement so that its ready to interact with database
	$sel_user = $link->prepare("SELECT name FROM users WHERE username=?");

	//set the parameters
	$sel_user->bind_param("s", $user);

	//execute the query
	$sel_user->execute();

	$sel_user->bind_result($db_name);

	//store the results
	$sel_user->store_result();

	$sel_user->fetch();
}

?>