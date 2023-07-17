<?php
	session_start();
	if (!empty($_SESSION['user_id']))
	{
	  $user_id = $_SESSION['user_id'];
	}else {
	  //validation as only logged in users can post
		header("Location: login.php");
	}
	//where to send user after post
	if (!empty($_GET['redirect']))
	{
	  $redirect = "profile.php?id=" . $_GET['redirect'];
	}else {
	  $redirect = "index.php";
	}

	$database = "social";
	// require function executes external scripts
	// relative pathname to file is the argument
	require('dbConnectScript.php');

	if (!empty($_POST['submission']))
  {
		$characters = $_POST['submission'];
	}else {
		$characters = 404;
	}

	$sqlInsert = "INSERT INTO posts (characters, user_id)
    VALUES('$characters','$user_id')";

	$result = mysqli_query($dbLink, $sqlInsert); // run the insert query

	if ($result) {
    	// if the query executed (true) display success message to the user
		echo "<p>Worked.</p>";
		// index.php
		header("Location: $redirect");
		exit();

	}
    else {
        echo "<p>Unable to add your details to our database.</p>";
      	echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
    }
	mysqli_close($dbLink);
?>
