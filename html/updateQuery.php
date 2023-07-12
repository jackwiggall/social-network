<?php

session_start();

$database = "social";
	// require function executes external scripts
	// relative pathname to file is the argument

	$host="localhost";
	$username="root";
	$pword="";
	$database="social";

	error_reporting(0);
	require('dbConnectScript.php');

	$bookingID = $_SESSION['bookingID'];

if( !empty($_POST["forenameChange"]) ) {
$forename = $_POST["forename"];
} else {
	$forename = $_SESSION['forename'];
}
if( !empty($_POST['surnameChange']) ) {
$surname = $_POST['surname'];
} else {
	$surname = $_SESSION['surname'];
}
if( !empty($_POST['timeChange']) ) {
$arrival = $_POST['arrival'];
} else {
	$arrival = $_SESSION['arrival'];
}
if( !empty($_POST["dateChange"]) ) {
$day = $_POST["day"];
} else {
	$day = $_SESSION['day'];
}
if( !empty($_POST["seatsChange"]) ) {
$seats = $_POST["seats"];
} else {
	$seats = $_SESSION['seats'];
}
if( !empty($_POST["requestsChange"]) ) {
$requests = $_POST["requests"];
} else {
	$requests = $_SESSION['requests'];
}

		$open = date('D', $day);

	if ($open = "Sat" or $open = "Sun") {
    	// check the opening time for the day
		if($arrival >= '09:30:00' && $arrival <= '21:00:00'){
			$accept = True;
		}
		else{
			echo "<p>Booking declined.</p>";
			$accept = False;
		};
	}
    else {
        if($arrival >= '10:00:00' && $arrival <= '20:00:00'){
			$accept = True;
		}
		else{
			echo "<p>Booking declined.</p>";
			$accept = False;
		};
    };

	if ($accept == false) {
		mysqli_close($dbLink);
		echo "<p>The time is not within our opening times. Please try again.</p>";
	}


	$_SESSION['newbookingID'] =  $arrival . $surname . $day;
	$newbookingID = $_SESSION['newbookingID'];

	$sqlUpdate = "UPDATE bookings
	SET bookingID='$newbookingID',forename='$forename',surname='$surname',seats='$seats',
	arrival='$arrival',day='$day',requests='$requests' WHERE bookingID='$bookingID'";

	$result = mysqli_query($dbLink, $sqlUpdate); // run the update query

	if ($result) {
    	// if the query executed (true) display success message to the user
		echo "<p>Booking accepted.</p>";
		echo "<p>Thanks for booking $forename $surname.</p>";
		echo "<p>You have a table for $seats on the $day at $arrival".".</p>";
		echo "<p>Your booking code is <b>"."$newbookingID"."</b> use this to edit your booking.</p>";
	}
    else {
        echo "<p>Unable to add your details to our database.</p>";
		//echo "<p>Possible duplicate information.</p>";
        //echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
    }
	mysqli_close($dbLink);

?>
