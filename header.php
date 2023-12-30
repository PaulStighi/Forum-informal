<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>Forum InFormal</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<img src = "Logo.png"; style = "float:left; width:8vw; height:8vw; padding: 2vw 0vw 0vw 2vw">
<img src = "Logo.png"; style = "float:right; width:8vw; height:8vw; padding: 2vw 2vw 0vw 0vw">
<br><br>
<a href = "index.php" style = "text-decoration: none" id = "sus"> <h1>Forumul Informal al Liceului Teoretic "Grigore Moisil" Timisoara</h1> </a>
    <div id="wrapper">
		<div id="menu">
			<a class="item" href="index.php">Home</a> -
			<a class="item" href="create_cat.php">Create a category</a> -
			<a class="item" href="create_topic.php">Create a topic</a>
			 
			<div id="userbar">
			<?php session_start();
				echo '<div id="userbar">';
					if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
					{
						echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a class = "item" href="signout.php">Sign out</a>';
					}
					else
					{
						echo '<a class = "item" href="signin.php">Sign in</a> or <a class = "item" href="signup.php">Create an account</a>.';
					}
				echo '</div>';
			?>
			</div>
		</div>
		<br><br><br>
		<div id="content">