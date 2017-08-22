<?php session_start();
	  include("db_conn.php"); 
	  include("admin_variables.php");

//Check username is set
if(!isset($_SESSION["username"])){
	header("Location: ../checker.php");
		exit();
	}
//Check if they are a admin
if($admin_check != 1){
	header("Location: ../checker.php");
	exit();
}
	
	//get the id of the record and using that update the record so its not visable
	$id = $_GET["id"];
	$statement = $link->prepare("UPDATE suggestion SET visable = 0 WHERE num = ?");
	$statement->bind_param('i' ,$id);
	$statement->execute();
	mysqli_close($link);
	//redirect back to the submitted page
	header("Location: ../submitted.php");
	exit();
?>