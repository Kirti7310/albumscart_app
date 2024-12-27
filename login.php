<!--LOGIN PAGE -->
<?php
session_start();
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?> 
<?php endif; ?>

<div class="form-action">
    <form action="auth.php" method="POST">
      <!-- Username  -->
      <div class="form-group">
        <label for="email">Username:</label>
        <input id="email" type="text" name="email" placeholder="Enter your username">
      </div>

      <!-- Password  -->
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password" placeholder="Enter your password">
      </div>

      <!-- Submit  -->
      <div class="form-group">
        <button type="submit" class="submit-btn">Login</button>
      </div>
    </form>
  </div>

</body>
</html>


