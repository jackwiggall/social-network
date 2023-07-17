<?php
session_destroy(); //errors if no existing session
session_start();

if (!empty($_POST['email']))
{
  $email = $_POST['email'];

}else {
  $email = "1";
}

if (!empty($_POST['psw']))
{
  $psw = $_POST['psw'];
}else {
  $psw = "1";
}

$user_id = 0;

require('db_connection.php');

//$get_profile = "SELECT * FROM `users` WHERE user_id = $user_id";
function getProfile($get_profile,$mysqli)
{
  if ($result = $mysqli->query($get_profile))
  {
    while ($row = $result->fetch_object()){

      $_SESSION['avatar'] = "https://$row->avatar_link";
      $_SESSION['name'] = "$row->forename $row->surname";
      //close the database connections
      $mysqli->close();
      header("Location: index.php");
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

  global $user_id, $email, $psw;

  if ($row->email == $email){
    if ($row->password == $psw) {
      $user_id = $row->user_id;
    }}
  }
}
//capture query errors
  else {
    if(!empty($mysqli->error ) ){
      echo $mysqli->error;  // <- this is not a function call error()
    }
  }

  if ($user_id!=0) {
    echo "<h3>Login successful.</h3>";
    $_SESSION['user_id'] = $user_id;
    $get_profile = "SELECT * FROM `users` WHERE user_id = $user_id";
    getProfile($get_profile,$mysqli);
  }else {
    echo "<h3>Login unsuccessful.</h3>";
  }
  //close the database connections
  $mysqli->close();
}


$query_string = "SELECT * FROM `accounts`";
runQuery($query_string,$mysqli);

?>
