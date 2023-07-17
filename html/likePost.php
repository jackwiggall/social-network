<?php
session_start();
if (!empty($_SESSION['user_id']))
{
  $user_id = $_SESSION['user_id'];
}else {
  //validation as only logged in users can like posts
  header("Location: login.php");
}

if (!empty($_GET['post_id']))
{
  $post_id = $_GET['post_id'];
}else {
  //error
  $post_id = 0;
}

function getPost($get_post,$mysqli)
{
  if ($result = $mysqli->query($get_post))
  {
    while ($row = $result->fetch_object()){

      if (!empty($row->likes)) {
        $newLikes = $row->likes + 1;
      }else {
        $newLikes = 1;
      }

      echo "<h1>new likes is $newLikes</h1>";
      updatePost($newLikes);
    }
  }
}

function updatePost($newLikes)
{
  global $post_id;
  require('dbConnectScript.php');
  $sqlUpdate = "UPDATE `social`.`posts` SET `likes` = $newLikes WHERE `posts`.`post_id` = $post_id";
  $result = mysqli_query($dbLink, $sqlUpdate); // run the insert query
  if ($result) {
    echo "<h1>Updated</h1>";
    header("Location: index.php");
  }
    else {
        echo "<p>Unable to update your details to our database.</p>";
        echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
    }
  mysqli_close($dbLink);
}

if ($post_id != 0) {

  require('dbConnectScript.php');
  require('db_connection.php');

  $sqlInsert = "INSERT INTO likes (post_id, user_id)
    VALUES('$post_id','$user_id')";
    $result = mysqli_query($dbLink, $sqlInsert); // run the insert query

  	if ($result) {
      echo "<h1>Inserted</h1>";
      $get_post = "SELECT * FROM `users` WHERE user_id = $user_id";
      getPost($get_post,$mysqli);
  	}
      else {
          echo "<p>Unable to insert your details to our database.</p>";
        	echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
      }
}

?>
