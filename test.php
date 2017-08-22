<?php include("include/db_conn.php");

	for ($x = 0; $x <= 100; $x++){
		$i = "Alex";
		$ii = "Test";
		$iii = $x;

		$statement = $link->prepare("INSERT INTO suggestion (author, type, content, visable, rating, checked) VALUES (?, ?, ?, 0, 0, 0)");
		$statement->bind_param('sss', $i, $ii, $iii);
		$statement->execute();
	}
?>