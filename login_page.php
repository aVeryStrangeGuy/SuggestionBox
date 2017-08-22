<?php include("include/db_conn.php"); 
	  include("include/menu.php");?>
	<main>
		<div class = "content">
			<?php 
				// If you fail and are sent back to page with fail get variable
				// display this message
			
				if(isset($_GET['fail']) && $_GET['fail'] == 1) {
				echo '<div class="alert">Username or password is not correct, try again! </div>';
			}?>
			<!-- Form Styling -->
			<div class="login_container">
				<form action='include/login.php' method='post'>
				<table class="login">
				<tr align='center'>
				<td colspan='3'><h2>User Login</h2></td>
				</tr>
				<tr>
				<td>Username</td>
				<td><input type='text' name='username' required='required'></td>
				</tr>
				<tr>
				<td>Password:</td>
				<td><input type=password name='pass' required='required'></td>
				</tr>
				<tr>
				<td colspan='3'>
				<input type="submit" name='login' value='Login'>
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