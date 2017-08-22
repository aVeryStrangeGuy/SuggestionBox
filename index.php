<?php session_start();
include("include/cookie_checker.php");
include("include/admin_variables.php");
include("include/suggestions_variables.php");
include("include/vote_variables.php");
include("include/menu.php");
 ?>

	<main>
		<div class = "content">
		<?php
			// If logged in show user name
			if(isset($_SESSION["username"])){
				echo '<div class="logged_in">You are logged in as: ' . $_SESSION["username"] . '</div>';
				}
			// If cookies are not enabled after a check show this message
			if( $enabaled == false ){
				echo '<div class="alert">You need to enable cookies to use this website effectively</div>';
			}
			else{
			}
			?>
			<!-- Page styling -->
			<p>
				Hello and welcome to the IT suggestion page. Here you can submit and rate ideas that you would like to see.
			</p>
			<p>
				To submit a suggestion go the suggestion tab in the navigation bar there is currently a max number of suggestions a day of: <strong><?php echo $max_suggestions; ?></strong>
			</p>
			<p>
				To vote on other peoples suggestions click on the submitted tab in the navigation bar there is currently a max number of votes a day of: <strong><?php echo $max_votes; ?></strong> 
			</p>

			<p>
				Rules:
				<ul>
					<li>Suggestion on this suggestion box need to be related to IT only</li>
					<li>No offensive or bullying behaviour</li>
					<li>Any bugs found please report to Systems adminstrator (Alex Boxall)</li>
					<li>All submissions are moderated before being put out to be voted on, so be aware they are being seen</li>
				</ul>
			</p>

			<p>
				If anyone has any issues or would like to be set up on this system please contact Systems adminstrator.
			</p>

		</div>
	</main>
</body>
<!-- <script src="js/scripts.js"></script> -->
</html>