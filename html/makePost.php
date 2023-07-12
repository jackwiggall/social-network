<?php

	$database = "social";
	// require function executes external scripts
	// relative pathname to file is the argument
	require('dbConnectScript.php');

	$characters = $_POST['submission'];
	$user_id = 1; //not implemented user system yet

	$sqlInsert = "INSERT INTO posts (characters, user_id)
    VALUES('$characters','$user_id')";

	$result = mysqli_query($dbLink, $sqlInsert); // run the insert query

	if ($result) {
    	// if the query executed (true) display success message to the user
		echo "<p>Worked.</p>";
	}
    else {
        echo "<p>Unable to add your details to our database.</p>";
      	echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
    }
	mysqli_close($dbLink);
?>
