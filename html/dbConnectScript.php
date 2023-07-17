<?php
	//connect to the database using mysqli API
	$host = "localhost";
	$username = "root";
	$pword = "";
	$database = "social";

	$dbLink = mysqli_connect($host, $username, $pword, $database);
	// mysqli_connect() returns NULL (i.e. FALSE) if unsuccessful else it
	// returns an object referring to the link to the database on MySQL server
	// Below - not NULL evaluates to TRUE
	if (!$dbLink) {
		echo "Failed to connect to MySQL:";
		die(mysqli_connect_error());
	}
?>
