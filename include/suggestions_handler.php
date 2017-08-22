<?php session_start();
	  include("db_conn.php");
	  include("suggestions_variables.php");
	  
	  	//pulls the post type and the suggestion from the page
		$type = $_POST["type"];
		$suggestion = $_POST["suggestion"];
		
		//This sets the name on the post depending if suggestion is annoymous or now
		if ($_POST["name"] == "user"){
			$name = $db_name;
		}
		elseif ($_POST["name"] == "anonymous"){
			$name = "Anonymous";
		}

		//checks if user is logged in
		if(!isset($_SESSION["username"])){
			header("Location: ../suggestions.php");
			exit();
		}

		//checks if any of the fields are blank
		if (($type != "") && ($suggestion != "") && ($name != "")){

			//If you have reach the  maxium number of suggestions redirect back to suggestions page
			if(($max_suggestions <= $suggestions_today && $current_date == $suggestions_expiry)){
					header("Location: ../suggestions.php");
					exit();
				}
			//If it the first suggestion of the day update the users suggestions today with date
			elseif($suggestions_today = 0 || $suggestions_expiry != $current_date){
				$statement = $link->prepare("UPDATE users SET suggestions_today = 1, suggestions_expiry = ? WHERE username = ?");
				$statement->bind_param('ss', $current_date ,$user);
				$statement->execute();
			}
			//else only update the number of suggestions that day
			else{
				$statement = $link->prepare("UPDATE users SET suggestions_today = suggestions_today + 1 WHERE username = ?");
				$statement->bind_param('s' ,$user);
				$statement->execute();
			}
			//Insert the suggestion into the database
			$statement = $link->prepare("INSERT INTO suggestion (author, type, content, visable, rating, checked) VALUES (?, ?, ?, 0, 0, 0)");
			$statement->bind_param('sss', $name, $type, $suggestion);

			//this is a check to see if ececuted properly
			if($statement->execute() == TRUE){
				header("Location: ../suggestions.php?check=true&id=2");
				exit();
			} else {
				echo $link->error;
				die(); 
			}
		}
		//if the field are not all filed in
		else{
		header("Location: ../suggestions.php?check=true&id=3");
		exit();
		}
?>