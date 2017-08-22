<?php
//establish link
 $link = mysqli_connect("localhost", "alex", "alex", "suggestion");
//if error print out error
  if (!$link) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }

?>