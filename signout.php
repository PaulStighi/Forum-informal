<?php

include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
   session_destroy();
}
 
echo '<h3>Sign out</h3>';

echo "You are now signed out. You can sign back in : ";
echo '<a href="signin.php" style = "color: black">click here</a>';
 
include 'footer.php';
?>