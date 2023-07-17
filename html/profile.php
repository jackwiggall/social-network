<?php
  session_start();
  if (!empty($_GET['id']))
  {
    $id = $_GET['id'];
  }else {
    $id = 0;
  }
  if (!empty($_SESSION['user_id']))
  {
    //user is logged in
    if ($id == $_SESSION['user_id'])
    {
      //user is visiting own profile
      $profile = true;
    }else {
      $profile = false;
    }
  }else {
    //user not logged in
    $profile = false;
  }

  $avatar = "";
  $name = "";

?>

<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
</head>
<body class="w3-theme-l5">

  <div class="navbar">
  <?php include 'navbar.php';?>
  </div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="https://www.w3schools.com/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
        </div>
      </div>
      <br>

      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="https://www.w3schools.com/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>
      </div>
      <br>

      <!-- Interests -->
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Interests</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
          </p>
        </div>
      </div>
      <br>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">

      <!--IF NOT USER DONT SHOW-->
      <?php
      if ($profile) {
      echo '
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Got something to share?</h6>
              <form action="makePost.php?redirect='.$id.'" method="post">
              <input type="text" required name="submission" class="w3-border w3-padding w3-margin-bottom" style="display:block;width:100%">
              <button type="submit" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>
            </form>
            </div>
          </div>
        </div>
      </div>';
      }

      require('db_connection.php');

      function timeago($date) {
    	   $timestamp = strtotime($date);

    	   $strTime = array("sec", "min", "h", "d", "m", "y");
    	   $length = array("60","60","24","30","12","10");

    	   $currentTime = time();
    	   if($currentTime >= $timestamp) {
    			$diff     = time()- $timestamp;
    			for($i = 0; $diff >= $length[$i] && $i < count($length); $i++) {
    			$diff = $diff / $length[$i];
    			}

    			$diff = round($diff);
    			return $diff . $strTime[$i];
    	   }
    	}

      function getProfile($get_profile,$mysqli)
      {
        if ($result = $mysqli->query($get_profile))
      	{
          while ($row = $result->fetch_object()){

            global $id, $avatar, $name;
            $avatar = "https://$row->avatar_link";
            $name = "$row->forename $row->surname";
            //get more data from query

          }
        }
      }

      function runQuery($query_string,$mysqli) {
      //run the query
      	if ($result = $mysqli->query($query_string))
      	{
      //iterate over each row in the results set and output a table row
      	while ($row = $result->fetch_object()){
      	//item found from database

        $strTimeAgo = "";
      	$strTimeAgo = timeago($row->timestamps);

        global $id, $avatar, $name;

        //ADD DELETE BUTTON FOR USER WHO MADE POST
      	echo "<div class='w3-container w3-card w3-white w3-round w3-margin'><br>
        <a href='profile.php?id=$row->user_id' style='text-decoration:none'>
          <img src='$avatar' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
          <span class='w3-right w3-opacity'>$strTimeAgo</span>
          <h4> $name <span class='w3-opacity'>#$row->user_id</span> </h4></a><br>
          <hr class='w3-clear'>
          <p> $row->characters </p>
          <a href='likePost.php?post_id=$row->post_id'><button type='button' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='fa fa-thumbs-up'> </i> $row->likes </button></a>
          <button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-comment'> </i> $row->likes </button>
        </div>";

        //$result->close();	 //free the $result set (clear it)
        }
      }
      //capture query errors
      	else {
          if(! empty( $mysqli->error ) ){
            echo $mysqli->error;  // <- this is not a function call error()
          }
        }
      //close the database connections
      	$mysqli->close();
      }

      $get_profile = "SELECT * FROM `users` WHERE user_id = $id";
      getProfile($get_profile,$mysqli);

      $query_string = "SELECT * FROM `posts` WHERE user_id = $id ORDER BY post_id DESC";
  		runQuery($query_string,$mysqli);
      ?>

    <!-- End Middle Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="https://www.w3schools.com/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center" id="friend_request">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="https://www.w3schools.com/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
          <span>Jane Doe</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" id="acceptBtn" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" id="declineBtn" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>

    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>
<br>


<div class="footer">
<?php include 'footer.php';?>
</div>

<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else {
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className =
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

document.getElementById("acceptBtn").addEventListener("click", hideRequest, false);
document.getElementById("declineBtn").addEventListener("click", hideRequest, false);

//used to toggle display friend request
function hideRequest() {
  var x = document.getElementById("friend_request");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace("w3-show", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
