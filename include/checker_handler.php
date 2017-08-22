<?php session_start();
	  include("db_conn.php"); 
	  include("admin_variables.php");

// Go back to checker if username is not set
if(!isset($_SESSION["username"])){
	header("Location: ../checker.php");
		exit();
	}

//Get variables
$id = $_GET["id"];
$approval = $_GET["approval"];
$user = $_SESSION["username"];

//Check if they are an admin
if($admin_check != 1){
	header("Location: ../checker.php");
	exit();
}
//If approved - update table to make visable on submitted page and redirect to checker page
if ($approval == "true"){
	$statement = $link->prepare("UPDATE suggestion SET visable = 1 , checked = 1 WHERE num = ?");
	$statement->bind_param('i' ,$id);
	$statement->execute();
	mysqli_close($link);
	header("Location: ../checker.php");
	exit();
}
//if denied - update table to make not visable on checker page and redirect to checker page
elseif ($approval == "false"){
	$statement = $link->prepare("UPDATE suggestion SET checked = 1 WHERE num = ?");
	$statement->bind_param('i' ,$id);
	$statement->execute();
	mysqli_close($link);
	header("Location: ../checker.php");
	exit();
}
// error checking
else{
	echo "error";

}

?>