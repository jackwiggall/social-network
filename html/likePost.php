<?php
session_start();
if (!empty($_SESSION['user_id']))
{
  $user_id = $_SESSION['user_id'];
}else {
  //validation as only logged in users can like posts
  header("Location: login.php");
}

if (!empty($_GET['redirect']))
{
  $redirect = $_GET['redirect'];
}else {
  $redirect = "index.php";
}

if (!empty($_GET['post_id']))
{
  $post_id = $_GET['post_id'];
}else {
  //error
  $post_id = 0;
}

function getPost($get_post,$mysqli,$liked)
{
  if ($result = $mysqli->query($get_post))
  {
    while ($row = $result->fetch_object()){

      if (!$liked) { //has user already liked post
        if (!empty($row->likes)) {
          $newLikes = $row->likes + 1;
        }else {
          $newLikes = 1;
        }
      }else {
          $newLikes = $row->likes - 1;
      }

      echo "<h1>new likes is $newLikes</h1>";
      updatePost($newLikes);
    }
  }
}

function updatePost($newLikes)
{
  global $post_id, $redirect;
  require('dbConnectScript.php');
  $sqlUpdate = "UPDATE `social`.`posts` SET `likes` = $newLikes WHERE `posts`.`post_id` = $post_id";
  $result = mysqli_query($dbLink, $sqlUpdate); // run the insert query
  if ($result) {
    //echo "<h1>Updated</h1>";
    header("Location: $redirect");
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

    $sqlInsert = "INSERT INTO likes (post_id, user_id) VALUES('$post_id','$user_id')";
    echo "<h1>Inserting</h1>";
    $result = mysqli_query($dbLink, $sqlInsert); // run the insert query
    $get_post = "SELECT * FROM `posts` WHERE post_id = $post_id";

  	if ($result) {
      //echo "<h1>resulted</h1>";
      $liked = false;
      getPost($get_post,$mysqli,$liked);
  	}else {
        $liked = true; //already exists in database, remove like
        $sqlInsert = "DELETE FROM `likes` WHERE post_id = $post_id AND user_id = $user_id";
        $result = mysqli_query($dbLink, $sqlInsert); // run the insert query

      	if ($result) {
          getPost($get_post,$mysqli,$liked);
      	}else {
          echo "<p>Unable to add your details to our database.</p>";
        	echo "<p>Error description: " . mysqli_error($dbLink)."</p>";
        }
      }
}

?>
