<?php session_start();
	  include("include/db_conn.php"); 
	  include("include/vote_variables.php");
	  include("include/admin_variables.php"); 
	  include("include/menu.php");
?>
	<main>
		<div class = "content">
			<?php
				//if user is logged in show there name
				if(isset($_SESSION["username"])){
				echo '<div class="logged_in">You are logged in as: ' . $_SESSION["username"] . '</div>';
				}

				// ---------------- Pagification ---------------------
				//number of results per page
				$per_page=4;
				if (isset($_GET["page"])) {
				$page = $_GET["page"];
				}
				else {
				$page=1;
				}
				// What will be loaded onto the page by page number
				// Page will start from 0 and Multiple by Per Page
				$start_from = ($page-1) * $per_page;	

				//Query to retrieve un-checked suggestions			
				$query = $link->prepare("SELECT * FROM  suggestion WHERE visable = 1  ORDER BY rating DESC LIMIT ?, ?");
				$query->bind_param("ii", $start_from, $per_page);
				$query->execute();
				//store results and number of rows
				$result = $query->get_result();
				$num_of_rows = $result->num_rows;

				//If user is not logged in
				if(!isset($_SESSION["username"])){
					echo '<div class="alert"> In order to vote you need to login </div>';
				}
				//if there are not suggestions
				elseif($num_of_rows == 0){
					echo '<div class="alert">There are no suggestions to vote on at the moment</div>';
				}
				//If the dates dont match reset the users vote count
				elseif($current_date != $votes_expiry){
					echo '<div class="alert"> You have 5 votes remaining today<br/> </div>';
				}
				//else show how many votes are left for the user
				else{
					echo '<div class="alert"> You have ' .($max_votes - $votes_today) . ' votes remaining today<br/> </div>';
				}

				// If there are results to display
				if($num_of_rows >= "1"){
					//itterate through the results
					while($row = $result->fetch_assoc()){
					// Styling constructor
					echo '	<div class="reviewer">
							<div class="review">';
					echo $row['type'];
					echo " suggestion";
					echo "<br/> <br/>";
					echo strip_tags($row['content']);
					echo "<br/> <br/>";
					if ($row['author'] != NULL){
						echo "Suggested by ". $row['author'];
					}
					else{
						echo "Suggested by Anonymous";
					}
		    		echo '</div>';
		    		// If admin show the option to remove the suggestion
		    		if ($admin_check == 1){
						echo '<div class=admin_remove>';
								echo '<a href= "include/remove_handler.php?id=' .$row['num']. '">';
								echo '<img src="images/cross.png" /></a>';
						echo '</div>';
					}

					echo	'<div class="response">
								<div class="rating_arrows">';
					// If the user is logged in and the user has either
					// hasnt reached your max votes for the day 
					// or its the a new day show voting buttons
					if( ($votes_today < $max_votes && isset($_SESSION["username"])) || $current_date != $votes_expiry && isset($_SESSION["username"]) ){
						echo 			'<a href= "include/rating.php?rating=up&id=' .$row['num']. '">';
						echo			'<img src="images/upv2.png" /></a>';
						echo 			'<a href= "include/rating.php?rating=down&id=' .$row['num']. '">';
						echo			'<img src="images/downv2.png" /></a>';
					}
					// else show greyed out buttons
					else if ( !isset($_SESSION["username"]) || $votes_today >= $max_votes ){
						echo			'<img src="images/up_greyv2.png" />';
						echo			'<img src="images/down_greyv2.png" />';
					}
					echo		'</div><div class="rating">'; 
					// If rating is above what the admin has defined as a high
					// amount of votes show green text
					if($row['rating'] >= $high_votes){
						echo '<div class="green_text">';
					}
					// If rating is below what the admin has defined as a low
					// amount of votes show red text
					elseif($row['rating'] <= $low_votes){
						echo '<div class="red_text">';
					}
					// Else apply no styles
					else{
						echo '<div>';
					}
					echo 			$row['rating'];
					echo 		'</div>';
					echo 		'</div>
					</div>';
										echo	'</div>';
					
					}
					// ---------------- Pagification ---------------------
					//Query to check how many pending suggestions there are
					$query = ("SELECT * FROM  suggestion WHERE visable = 1");
						$result = $link->query($query);
						$total_records = $result->num_rows;
						//Using ceil function to divide the total records on per page
						$total_pages = ceil($total_records / $per_page);
						echo "Total Suggestions: " . $total_records;
						
						// Work out what number to display
						// Always 9 different pages where avaliable
						// If not display up to the point and stop
						if($total_records > $per_page){
							if($total_pages <= 10){
								$start = 2;
								$finish = $total_pages - 1;
							}
							elseif(($page + 4) >= $total_pages){
								$start = $page - 7 + ($total_pages - $page); 
								$finish = $total_pages - 1;
							}
							elseif(($page - 4) <= 1){
								$start = 2;
								$finish = $page + (8 - $page);
							}
							else{
								$start = $page - 3;
								$finish = $page + 3;
							}

						// Page numbers at bottom of page
						echo "<div class='pagenum_wrap'>
								<div class='pagenum'>";
									//if isnt 1 display the back button
									if($page != 1){
										echo " <a href='submitted.php?page=".($page - 1)."'>";
										echo "<img src = 'images/back.png' /></a>";
										echo "<span><div class='pages'><a href='submitted.php?page=1'>1</a><br/></div>";
									}
									//else display a greyed out un-clickable button
									else{
										echo "<img src = 'images/back_grey.png' />";
										echo "<span><div class='pages'><span class='red_text'>1</span><br/></div>";
									}
									// If page number goes over 5 display dots between
									// the first and the 2nd number
									if ($page > 5){
										echo "<div class='pages'>.....</div>";
									}

						// For each number display a number with a link the
						// the page with the same number
						for ($i=$start; $i<=$finish; $i++) {
							if($i == $page){
							echo "<div class='current_page pages'>".$i."<br/></div>";
							}
							else{
							echo "<div class='pages'><a href='submitted.php?page=".$i."'>".$i."</a><br/></div>";
							}
						};
						// If approaching the end of the range of pages stop displaying
						// dots after
							if(($total_pages - $page) > 5){
								echo "<div class='pages'>.....</div>";
							}
						//if isnt the last page display the forward button	
							if($page != $total_pages){
							echo "<div class='pages'><a href='submitted.php?page=".$total_pages."'>".$total_pages."</a><br/></div></span>";
							echo " <a href='submitted.php?page=".($page + 1)."'>";
							echo " <img src = 'images/forward.png' /></a>";
							}
						//else if last page display greyed out arrow		
							else{
								echo "<div class='pages'><span class='red_text'>".$total_pages."</span></a><br/></div></span>";
								echo "<img src = 'images/forward_grey.png' />";
							}
						}
					}
			?>

		</div>
	</main>
</body>
<!-- <script src="js/scripts.js"></script> -->
</html>