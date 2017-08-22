<?php
session_start();
include("include/db_conn.php");?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>IT Suggestions</title>
  <meta name="description" content="IT Suggestions">
  <meta name="author" content="Alex Boxall">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
</head>
<body>
	<!-- Header and Nav Bar (not include version as need to have no options)-->
	<header class="header">
		<div class="header_logo"><img src="images/logo.png" /><br/></div>
		<div class="header_title">IT Suggestions</div>
	</header>
	<nav class ="nav_bar">
		<ul class = "nav_items">
		</ul>
	</nav>
	<main>		
		<div class = "content">
			<?php
			// If user name is set show username
			if(isset($_SESSION["username"])){
				echo '<div class="logged_in">You are logged in as: '. $_SESSION["username"] .'</div>';
				}
			// If you fail and are sent back to page with fail get variable
			// display this message
			if(isset($_GET['fail']) && $_GET['fail'] == 1) {
				echo '<div class="alert">Password is not correct, try again! </div>';
			}?>
			<!-- Form Styling -->
			<div class="login_container">
				<form action='include/new_pass_handler.php' method='post'>
				<table class="login">
				<tr align='center'>
				<td colspan='3'><h2>New Password</h2></td>
				</tr>
				<tr>
				<td>Current Password</td>
				<td><input type='password' name='current_pass' required='required'></td>
				</tr>
				<tr>
				<td>New Password:</td>
				<td><input type=password name='new_pass' required='required'></td>
				</tr>
				<tr>
				<td colspan='3'>
				<input type="submit" name='submit' value='Submit'>
				<br/><br/>
				</td>
				</tr>
				<tr>
				</tr>
				</table>
				</form>
			</div>
		</div>
	</main>
</body>
<!-- <script src="js/scripts.js"></script> -->
</html>