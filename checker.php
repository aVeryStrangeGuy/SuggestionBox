<?php session_start();
	  include("include/db_conn.php"); 
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
			?>
			<?php 
				//Check if they are a admin
				if($admin_check == 1){

					// ---------------- Pagification ---------------------
					//number of results per page
					$per_page=5;
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
					$query = $link->prepare("SELECT * FROM  suggestion WHERE visable = 0 AND checked = 0 LIMIT ?, ?");
					$query->bind_param("ii", $start_from, $per_page);
					$query->execute();
					//store results and number of rows
					$result = $query->get_result();
					$num_of_rows = $result->num_rows;

					//If there are results to display
					if($num_of_rows >= "1"){
						//itterate through the results
						while($row = $result->fetch_assoc()){
							//Styling constructor
							echo '<div class="reviewer">';
							echo '<div class="review">';
							echo $row['type'];
							echo ' suggestion';
							echo '<br/> <br/>';
							echo strip_tags($row['content']);
							echo '<br/> <br/>';
							echo 'Suggested by '. $row['author'];
				    		echo '</div>
				    			<div class="response">
				    			<div class="approve_deny">';

				    		echo 	'<a href= "include/checker_handler.php?approval=true&id=' .$row['num']. '">';
							echo	'<img src="images/tick.png" /></a>';
							echo 	'<a href= "include/checker_handler.php?approval=false&id=' .$row['num']. '">';
							echo	'<img src="images/cross.png" /></a>';
				    		echo'</div>
					    		<div class="approve_deny_label">
					    		Approve <br/><br/>
					    		Deny 
					    		</div>
					    		</div>
								</div>';
						}

						// ---------------- Pagification ---------------------
						//Query to check how many pending suggestions there are
						$query = ("SELECT * FROM  suggestion WHERE visable = 0 AND checked = 0");
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
										echo "<a href='checker.php?page=".($page - 1)."'>";
										echo "<img src = 'images/back.png' /></a>";
										echo "<span><div class='pages'><a href='checker.php?page=1'>1</a><br/></div>";
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
							echo "<div class='pages'><a href='checker.php?page=".$i."'>".$i."</a><br/></div>";
							}
						};

						// If approaching the end of the range of pages stop displaying
						// dots after
							if(($total_pages - $page) > 5){
								echo "<div class='pages'>.....</div>";
							}
						//if isnt the last page display the forward button
							if($page != $total_pages){
							
							echo "<div class='pages'><a href='checker.php?page=".$total_pages."'>".$total_pages."</a><br/></div></span>";
							echo " <a href='checker.php?page=".($page + 1)."'>";
							echo "<img src = 'images/forward.png' /></a>";
							}
						//else if last page display greyed out arrow	
							else{
								echo "<div class='pages'><span class='red_text'>".$total_pages."</span></a><br/></div></span>";
								echo "<img src = 'images/forward_grey.png' />";
							}
						}
					}
					// If no suggestions to be checked show this message
					else{
						echo '<div class="alert">There are no suggestions to be checked at the moment</div>';
					}
				}
				//if not admin display this
				else{
					echo '<div class="alert"> You need to be an admin to have access to this page </div>';
				}

			?>
		</div>
	</main>
</body>
</html>