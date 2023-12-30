<?php

include 'header.php';
include 'connect.php';

echo '<h3>Create a category</h3> <br>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	if(!isset($_SESSION['signed_in']))
	{
		echo 'Sorry, you have to be <a href="signin.php" style = "color: black">signed in</a> to create a category.';
	}
    else
	{
		echo "<form method='post' action=''>
			Category name: <input type='text' name='cat_name' /> <br><br>
			Category description: <br> <textarea name='cat_description' /></textarea> <br><br>
			<input type='submit' value='Add category' />
			</form>";
	}
}
else
{
	$name = mysqli_real_escape_string($con, $_POST['cat_name']);
	$desc = mysqli_real_escape_string($con, $_POST['cat_description']);
	
    $sql = "INSERT INTO categories(cat_name, cat_description, cat_date)
			VALUES('$name','$desc', NOW());";
    $result = mysqli_query($con, $sql);
    if(!$result)
    {
        echo 'Error' . mysqli_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}

include 'footer.php';
?>