<?php

session_start();

if((!isset($_SESSION['email'])) && (!isset($_SESSION['user_email'])))
{
  header('Location:login.php');
  exit();
}

if(isset($_SESSION['email']))
{
  $user_id = $_SESSION['l_id'];
}
elseif(isset($_SESSION['user_id']))
{
  $user_id =$_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
}


if($user_id == 0)
{
  $display_msg = "Welcome Admin";
}
elseif($user_id){
  $display_msg = "Welcome ".$user_name."!";
}
else{
  
    $display_msg = "Welcome User";
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
   <link rel="stylesheet" type="style/css" href="css/welcome.css">
</head>
<body>
<header>
    <h1 class="head-main1" style="color:black;"><?php echo $display_msg; ?></h1>
</header>


  <?php
  
include 'index.php';


?>


</body>
</html>

