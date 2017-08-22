<?php session_start();
include("include/admin_variables.php"); 
include("include/menu.php");
 ?>
	<main>
		<div class = "content">
		<?php
			// If logged in show user name
			if(isset($_SESSION["username"])){
				echo '<div class="logged_in">You are logged in as: ' . $_SESSION["username"] . '</div>';
				}

			if(isset($_GET['err'])){
				$err = $_GET['err'];
				
				// Messages to return when various actions are done or are not fully completed
				// (Successfully create new user, Username already existing, Password reset,
				// deleting a user and not confirming you wanted to delete a user)
				if($err == 0){
					echo '<div class="alert">You have successfully created a new user</div>';
				}
				if($err == 1){
					echo '<div class="alert">The username you are trying to create already exists</div>';
				}
				if($err == 3){
					echo '<div class="alert">Password has been sucessfully reset</div>';
				}
				if($err == 4){
					echo '<div class="alert">You have successfully deleted the user</div>';
				}
				if($err == 5){
					echo '<div class="alert">You did not confirm that you wanted to delete the user</div>';
				}
			}
			else{
			}
			// Check if the user is an admin 
			if($admin_check == 1){
				?>
			<!-- Form styling -->
			<form action="include/admin_handler.php" method="post">
				<fieldset class="form_fields">
					<legend class="form_legend"><h2> Create New User </h2></legend>
					<label class="form_label"> Username: </label>
					<input class="form_field"  type="text" name="new_username" required='required'><br/><br/>
					<label class="form_label"> Password: </label>
					<input class="form_field"  type="password" name="new_pass" required='required'><br/><br/>
					<label class="form_label"> Name: </label>
					<input class="form_field"  type="text" name="new_name" required='required'><br/><br/>
					<label class="form_label"> Admin?</label>
					<input type="radio" name="new_admin" value=1>  Yes<br/><br/>
					<label class="form_label"></label>
					<input type="radio" name="new_admin" value=0 checked="checked">  No<br/><br/>
					<div class="form_button">
				    	<input type="submit" value="Submit" name="new">
				    <div>
				</fieldset>
			</form>

			<form action="include/admin_handler.php" method="post">
				<fieldset class="form_fields">
					<legend class="form_legend"><h2> Reset Password  </h2></legend>
					<label class="form_label"> Username: </label>
					<select class="form_field"  name="reset_username" required='required'>
						<option value=""></option>
						<?php
						// Get the options for passwords to reset excluding yourself
						$user = $link->real_escape_string($_SESSION["username"]);
						$sel_user = $link->prepare('SELECT username FROM users WHERE username != ? ');
						$sel_user->bind_param("s", $user);
						$sel_user->execute();
						$sel_user->bind_result($username);
						while($sel_user->fetch()){
						    echo '<option value="' . $username . '" >' . $username . '</option>';
						}
						?>
					</select><br/><br/>
					<label class="form_label" required='required'> Password: </label>
					<input class="form_field"  type="password" name="reset_pass"><br/><br/>
					<div class="form_button">
				    	<input type="submit" value="Submit" name="reset">
				    <div>
				</fieldset>
			</form>

			<form action="include/admin_handler.php" method="post">
				<fieldset class="form_fields">
					<legend class="form_legend"><h2> Delete User </h2></legend>
					<label class="form_label"> Username: </label>
					<select class="form_field" name="delete_username" required='required'>
						<option value=""></option>
						<?php
						// Get the options for passwords to reset excluding yourself
						$user = $link->real_escape_string($_SESSION["username"]);
						$sel_user = $link->prepare('SELECT username FROM users WHERE username != ? ');
						$sel_user->bind_param("s", $user);
						$sel_user->execute();
						$sel_user->bind_result($username);
						while($sel_user->fetch()){
						    echo '<option value="' . $username . '" >' . $username . '</option>';
						}
						?>
					</select><br/><br/>
					<label class="form_label"> Are you sure? </label>
					<input type="radio" name="delete_check" value=1 required='required'>  Yes<br/><br/>
					<label class="form_label"></label>
					<input type="radio" name="delete_check" value=0 checked="checked">  No<br/><br/>
					<div class="form_button">
				    	<input type="submit" value="Submit" name="delete">
				    <div>
				</fieldset>
			</form>

			<?php 
			}
			// If not an admin show this message
			else{
				echo '<div class="alert"> You need to be an admin to have access to this page </div>';
			}
			?>
			
		</div>
	</main>
</body>
<!-- <script src="js/scripts.js"></script> -->
</html>