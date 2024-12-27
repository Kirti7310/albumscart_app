<?php
session_start();
include 'db.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Fetch user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Admin Login
    $sqlAdmin = "SELECT email, password, l_id FROM login_det WHERE email = ? LIMIT 1";
    $stmtAdmin = $conn->prepare($sqlAdmin);

    if ($stmtAdmin) {
        $stmtAdmin->bind_param('s', $email);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

        if ($resultAdmin->num_rows === 1) {
            $rowAdmin = $resultAdmin->fetch_assoc();
            if (password_verify($password, $rowAdmin['password'])) {
                // Admin Login
                $_SESSION['email'] = $email;
                $_SESSION['l_id'] = $rowAdmin['l_id'];
                $stmtAdmin->close();
                header('Location: explore.php');
                exit();
            } else {
                //  Admin Password
                $_SESSION['error_message'] = "Incorrect password!";
                $stmtAdmin->close();
                header('Location: login.php');
                exit();
            }
        }
        $stmtAdmin->close();
    }

    // User Login
    $sqlUser = "SELECT email, user_password, user_id,user_name FROM users WHERE email = ? LIMIT 1";
    $stmtUser = $conn->prepare($sqlUser);

    if ($stmtUser) {
        $stmtUser->bind_param('s', $email);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows  > 0) {
            $rowUser = $resultUser->fetch_assoc();
            //print_r($rowUser);exit;
            
          
            if (password_verify($password, $rowUser['user_password'])) {
               
                $_SESSION['user_email'] = $email;
                $_SESSION['user_id'] = $rowUser['user_id'];
                $_SESSION['user_name']=$rowUser['user_name'];
                // print_r($_SESSION['user_email']);
                // print_r($_SESSION['user_id']); exit;
                // $stmtUser->close();
                header('Location: index.php');
                exit();
            } else {
             
                //  User Password
                $_SESSION['error_message'] = "Incorrect password!";
                //$stmtUser->close();
                header('Location: login.php');
                exit();
            }
        }
        $stmtUser->close();
    }

    // No User Found
    $_SESSION['error_message'] = "No user found with that email!";
    header('Location: login.php');
    exit();
} else {
    // Missing Email or Password
    $_SESSION['error_message'] = "Please enter both email and password!";
    header('Location: login.php');
    exit();
}
?>