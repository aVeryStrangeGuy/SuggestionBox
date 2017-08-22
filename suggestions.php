<?php session_start();
	  include("include/db_conn.php");
	  include("include/suggestions_variables.php");
	  include("include/admin_variables.php"); 
	  include("include/menu.php");
	  ?>
	<main>
		<div class = "content">

			<?php
			// Get error id 
			// If not set error id to 0
			if(!isset($_GET["id"])){
				$err_id = 0;
			}
			else{
				$err_id = $_GET["id"];
			}
			// If logged in show user name
			if(isset($_SESSION["username"])){
				echo '<div class="logged_in">You are logged in as: ' . $_SESSION["username"] . '</div>';
				}
			// Return messages if certain error codes
			if($err_id == 2){
				echo '<div class="alert">You have successfully submitted a suggestion</div>';
			}
			if($err_id == 3){
				echo '<div class="alert">Your suggestion didnt submit as you didnt fill in all the fields</div>';
			}

			// If username is not set display this message
			if((!isset($_SESSION["username"]))){
				echo '<div class="alert">You need to login to be able to submit suggestions </div>';
			}
			// If they have reaxched the max number of suggestions they can make that day show this
			elseif($max_suggestions <= $suggestions_today && $current_date == $suggestions_expiry){
				echo '<div class="alert">You have reached your max number of suggestions for today</div>';
			}
			// Else display the form
			else{
				?>
				<!-- Form Styling -->
				<form class = "form" method="post" action="include/suggestions_handler.php">
				  <fieldset class="form_fields">
				    <legend class="form_legend">Suggestions Form:</legend>
				    <label class="form_label"> Name: </label>
				    <input id = "form_name_user" type="radio" name="name" value="user" checked="checked">
				    	<?php
				    		// include the name stored in the database as an option
				    		echo $db_name;
				    	?>
				     <br><br>
				    <label class="form_label"></label>
				    <input id = "form_name_anonymous"type="radio" name="name" value="anonymous" > Anonymous<br>
				    <br/>
				    <label class="form_label"> Type of suggestion: </label>
				    <select class="form_field" name="type" class="type" required='required'>
				      <option value=""></option>
				      <option value="Hardware">Hardware</option>
				      <option value="Software">Software</option>
				      <option value="Website">Website</option>
				      <option value="Other">Other</option>
				    </select> <br/> <br/>
				    <div class="form_suggestion_label"> Suggestion (200 character limit) : </div>
				    <div><textarea class="form_suggestion_field" name="suggestion" rows="10" cols="30" placeholder="Enter your suggestion here....." required='required' maxlength="200"></textarea></div>
				    <br/> <br/>
				    <div class="form_button">
				    	<input type="submit" value="Submit" name="submit">
				    <div>
				  </fieldset>
				</form> 
			<?php 
				}

			?>

		</div>
	</main>
</body>
</html>