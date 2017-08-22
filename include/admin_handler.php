<?php  session_start();
	   include("db_conn.php"); 
	   include("admin_variables.php");
	
	//check to see if user is set and that they are a admin
	if(!isset($_SESSION["username"]) || $admin_check != 1){
			header("Location: ../user.php");
			exit();
		}

	//If the user tries to create a new user
	if(isset($_POST['new'])){
		//pulling username from previous page
		$user = $_POST['new_username'];
		//check to see if the username doesnt already exist
		$sel_user = $link->prepare('SELECT username FROM users WHERE username = ? ');
		$sel_user->bind_param("s", $user);
		$sel_user->execute();
		$sel_user->store_result();
		$username_check = $sel_user->num_rows;
		if ($username_check != 0){
			header("Location: ../user.php?err=1");
			die();
		}
		//pulling password from the form and hash it 
		$pass = $_POST['new_pass'];
		$pass = password_hash( $pass, PASSWORD_BCRYPT);

		//pull othe rvariables needed to create user (name and admin check)
		$name = $_POST['new_name'];
		$admin = $_POST['new_admin'];

		//prepare the statement so that its ready to interact with database
		$sel_user = $link->prepare("INSERT INTO users (username, pass, name, votes_today, votes_expiry, suggestions_today, suggestions_expiry, admin, set_password) VALUES (?, ?, ?, 0, 0, 0, 0, ?, 0 )");;

		//set the parameters
		$sel_user->bind_param("sssi", $user, $pass, $name, $admin);

		//execute the query
		$sel_user->execute();

		//redirect back to the page 
		header("Location: ../user.php?err=0");
	}

	//if the user tries to reset a users password
	if(isset($_POST['reset'])){
		//pull the user name and password from the page
		$user = $_POST['reset_username'];
		$pass = $_POST['reset_pass'];
		$pass = password_hash( $pass, PASSWORD_BCRYPT);
		//prepare the statement so that its ready to interact with database
		$sel_user = $link->prepare("UPDATE users SET set_password = 0, pass = ? WHERE username = ?");
		$sel_user->bind_param('ss', $pass, $user);
		$sel_user->execute();
		//redirect back to the page 
		header("Location: ../user.php?err=3");
	}

	//if a user tries to delete a user
	if(isset($_POST['delete'])){
		
		$check = $_POST['delete_check'];
		if ($check == 1){
			$user = $_POST['delete_username'];
			$sel_user = $link->prepare("DELETE FROM users WHERE username = ?");
			$sel_user->bind_param('s', $user);
			$sel_user->execute();
			header("Location: ../user.php?err=4");
		}
		else{
			//redirect back to the page 
			header("Location: ../user.php?err=5");
		}
	}

?>