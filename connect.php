<?php
include 'connect_data.php';

$con = mysqli_connect($servername, $username,  $password);
 
if(!$con)
{
    exit('Error: could not establish database connection');
}

if(!mysqli_select_db($con, $database))
{
    exit('Error: could not select the database');
}

?>