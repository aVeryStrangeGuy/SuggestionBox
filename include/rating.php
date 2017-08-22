<?php
session_start();
include ("db_conn.php");
include ("vote_variables.php");

//If username is not set redirect back
if(!isset($_SESSION["username"])){
	header("Location: ../submitted.php");
		exit();
}

//Getting variables from the url
$id = $_GET["id"];
$rating = $_GET["rating"];
$user = $_SESSION["username"];

//if you have vote too many times today redirect back
if(($votes_today == 5 && $votes_expiry == $current_date) || !isset($_SESSION["username"])){
	header("Location: ../submitted.php");
	exit();
}
//if it your first vote of the day update vote number and expiry date
elseif($votes_today = 0 || $votes_expiry != $current_date){
	$statement = $link->prepare("UPDATE users SET votes_today = 1, votes_expiry = ? WHERE username = ?");
	$statement->bind_param('ss', $current_date ,$user);
	$statement->execute();
}
//else increase vote number by 1
else{
	$statement = $link->prepare("UPDATE users SET votes_today = votes_today + 1 WHERE username = ?");
	$statement->bind_param('s' ,$user);
	$statement->execute();
}

//if the person is trying to increase the rating
if ($rating == "up"){
	//update its rating to be one higher and execute
	$statement = $link->prepare("UPDATE suggestion SET rating = rating + 1 WHERE num = ?");
	$statement->bind_param('i' ,$id);
	$statement->execute();
	mysqli_close($link);
	//redirect back to submitted page
	header("Location: ../submitted.php");
	exit();
}
//if the person is trying to decrease the rating 
elseif ($rating == "down"){
	//update its rating to be one lower and execute
	$statement = $link->prepare("UPDATE suggestion SET rating = rating - 1 WHERE num = ?");
	$statement->bind_param('i' ,$id);
	$statement->execute();
	mysqli_close($link);
	//redirect back to submitted page
	header("Location: ../submitted.php");
	exit();
}
//this is to catch any errors or people trying to push another get variable
else{
	echo "error";

}
?>