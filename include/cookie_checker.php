<?php
//Check to see if been through loop by checking get value
if (isset($_GET['check']) && $_GET['check'] == true) {
    if (isset($_COOKIE['foo']) && $_COOKIE['foo'] == 'bar') {
        // cookie is working
        $enabaled = true;
    } else {
        // cookie is not working
        $enabaled = false; 
    }
//If it hasnt been through loop set a cookie and redirect back to same page with
// check = true get variable
} else {
   // set a cookie to test
    setcookie('foo', 'bar', time() + 3600);
    // redirecting to the same page to check 
    header("location: {$_SERVER['PHP_SELF']}?check=true"); 
}

?>