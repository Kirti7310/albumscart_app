<?php
session_start();

include 'db.php';


if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullname']) && isset($_POST['mobile']) && isset($_POST['c_password']))
  {
    // print_r("kirti!");exit;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];


    if($password !== $c_password )
    {
      $_SESSION['error_message']="The Confirm passwrd dosen't match!";
      header('Location:register_page.php');
      exit;;
    }

    $hased_pass = password_hash($password,PASSWORD_DEFAULT);

    $sql = "select email from users where email = ? LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0 )
    {
        $_SESSION['error_message'] = "Email is already taken!";
        header('Location: register_page.php');
        exit();
    
    }
    $insert_sql = "INSERT INTO users (email, user_password, user_name, user_phone) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param('sssi', $email, $hased_pass, $fullname, $mobile);
    if ($insert_stmt->execute()) {
      $_SESSION['email'] = $email;  // Set session for user
      $_SESSION['welcome_message'] = "Welcome, " . $fullname;  // Set welcome message
      header('Location: home.php');  // Redirect to home page
      exit();
  } else {
      $_SESSION['error_message'] = "An error occurred. Please try again!";
      header('Location: register_page.php');
      exit();
  }

  // Close the statements and connection
  $stmt->close();
  $insert_stmt->close();
  $conn->close();
} else {
  // If form data is missing, show error
  $_SESSION['error_message'] = "Please fill in all fields!";
  header('Location: register_page.php');
  exit();
}





  












?>