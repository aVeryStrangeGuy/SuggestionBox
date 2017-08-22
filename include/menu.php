<!doctype html>

<html lang="en">
<head>
  <!-- Page settings -->
  <meta charset="utf-8">
  <title>IT Suggestions</title>
  <meta name="description" content="IT Suggestions">
  <meta name="author" content="Alex Boxall">
  <!-- Responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
</head>
<body>
	<!-- Header -->
	<header class="header">
		<div class="header_logo"><img src="images/logo.png" /><br/></div>
		<div class="header_title">IT Suggestions</div>
	</header>
	</header>

	<!-- Nav bar  -->
	<nav class ="nav_bar">
		<ul class = "nav_items">
		<?php
		  	$this_page = $_SERVER['PHP_SELF'];

		 	if (stripos($this_page, 'index.php') !== FALSE){
		  		echo '<li class="active"><a href="index.php">Home</a></li>';
		  	}
		  	else{
		  		echo '<li ><a href="index.php">Home</a></li>';
		  	}

		  	if(stripos($this_page, 'suggestions.php') !== FALSE){			
		  		echo '<li class="active"><a href="suggestions.php">Suggestions</a></li>';
		  	}
		  	else{
		  		echo '<li><a href="suggestions.php">Suggestions</a></li>';
		  	}

		  	if(stripos($this_page, 'submitted.php') !== FALSE){
		  		echo '<li class="active"><a href="submitted.php">Submitted</a></li>';
		  	}
		  	else{
		  		echo '<li><a href="submitted.php">Submitted</a></li>';
		  	}

			if (isset($_SESSION['username'])){
		  		echo '<li ><a href="include/logout.php">Logout</a></li>';
			}
		  	else{
		  		if(stripos($this_page, 'login_page.php') !== FALSE){
		  			echo '<li class="active"><a href="login_page.php">Login</a></li>';
		  		}
		  		else{
		  			echo '<li><a href="login_page.php">Login</a></li>';
		  		}
		  }
		  ?>

		</ul>
	</nav>

	<!-- Nav bar for admin -->
	<?php 

	if(isset($_SESSION['username']) && $admin_check == 1){
		?>
		<nav class="admin_nav">
			<ul class="nav_bar">
				<?php
				if(stripos($this_page, 'checker.php') !== FALSE){
					echo '<li class="active"><a href="checker.php">Check Submissions</a></li>';
				}
				else{
					echo '<li><a href="checker.php">Check Submissions</a></li>';
				}
				if(stripos($this_page, 'user.php') !== FALSE){
					echo '<li class="active"><a href="user.php">User Management</a></li>';
				}
				else{
					echo '<li><a href="user.php">User Management</a></li>';
				}
				?>
			<ul>
		</nav>
		
	<?php
		}
	?>