<?php
	session_start();
	include ("db_conn.php");

	if(!isset($_SESSION["username"])){
		header("Location: ../index.php");
			exit();
	}

	if(isset($_POST['submit'])){
	//pull the user name and password from the page
	$user = $_SESSION['username'];
	$currentpass = $_POST['current_pass'];
	//prepare the statement so that its ready to interact with database
	$sel_user = $link->prepare("SELECT pass FROM users WHERE username=?");
	$sel_user->bind_param("s", $user);
	$sel_user->execute();
	//Store hashed password
	$sel_user->bind_result($hashedpass);
	$sel_user->store_result();
	$sel_user->fetch();
	//Set up variable so can handle pass not match
	$match = false;
	//check hashed pass against non hashed pass
	if (password_verify($currentpass, $hashedpass)) {
	    $match = true;
	}
	//if passwords match
	if($match == true){
	//pull new password and update the databse with it
	$newpass = $_POST['new_pass'];
	$newpass = password_hash( $newpass, PASSWORD_BCRYPT);
	$statement = $link->prepare("UPDATE users SET set_password = 1, pass = ? WHERE username = ?");
	$statement->bind_param('ss', $newpass, $user);
	$statement->execute();
	//redirect to index page
	header("Location: ../index.php");
	}
	else{
		//else return to newp_pass page for another attempt
		header("Location: ../new_pass.php?fail=1");
	}

	}
?>