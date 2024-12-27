
<?php 
session_start();
include 'db.php';


if(!isset($_SESSION['email']))
{
  header('Location: login.php');
    exit();
}


if (isset($_SESSION['welcome_message'])) {
  $welcome_message = $_SESSION['welcome_message'];
  unset($_SESSION['welcome_message']);  // Clear the welcome message after displaying
} else {
  $welcome_message = "Welcome to the homepage!";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h1><?php echo $welcome_message; ?></h1>

<a href="index.php">GO BACK TO Main page </a>

</body>
</html>