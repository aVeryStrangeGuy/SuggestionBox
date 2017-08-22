<?php

// establishing the MySQLi connection
include("db_conn.php");
//start session so can set variables
session_start();
//set match to false so can deal with if passwords dont match
$match = false;
//if 
if(isset($_POST['login'])){
//pull the user name and password from the page
$user = $link->real_escape_string($_POST['username']);
$currentpass = $_POST['pass'];
//prepare the statement so that its ready to interact with database
$sel_user = $link->prepare("SELECT pass FROM users WHERE username=?");
$sel_user->bind_param("s", $user);
$sel_user->execute();
//store the hashed pass
$sel_user->bind_result($hashedpass);
$sel_user->store_result();
$sel_user->fetch();

//check if hashed pass matches unhashed one
if (password_verify($currentpass, $hashedpass)) {
    $match = true;
}

//check if user and pass exist
if(($sel_user->num_rows) > 0 && $match == true){

	//check to see if first login or if password has been reset so they can change passwork
	$sel_user = $link->prepare("SELECT set_password FROM users WHERE username=?");
	$sel_user->bind_param("s", $user);
	$sel_user->execute();
	$sel_user->bind_result($first_login);
	$sel_user->store_result();
	$sel_user->fetch();

	//if they are a new user or password has been reset
	if($first_login == 0){
		$_SESSION["username"] = $user;
		//redirect to new_pass
		header("Location: ../new_pass.php");
	}
	//if they are a returning user
	elseif ($first_login == 1){
		$_SESSION["username"] = $user;
		//redirect to index
		header("Location: ../index.php");
	}
	else{
		echo "error with data in database";
		die();
	}
}
else {
	//return the login page
	header("Location: ../login_page.php?fail=1");
}
}
?>
