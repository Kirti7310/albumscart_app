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
  <link rel="stylesheet" href="css/register.css">
</head>
<body>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?> <!-- Clear the error message after displaying -->
<?php endif; ?>

<div class="form-action">
    <form action="authreg.php" method="POST">
      <!-- Username Field -->
      <div class="form-group">
        <label for="email">Username:</label>
        <input id="email" type="text" name="email" placeholder="Enter your username">
      </div>

      <!-- Password Field -->
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password" placeholder="Enter your password">
      </div>

      <div class="form-group">
        <label for="c_password">Confirm Password:</label>
        <input id="password" type="password" name="c_password" placeholder="Confirm your password">
      </div>

      <div class="form-group">
        <label for="fullname">Full-Name:</label>
        <input id="fullname" type="text" name="fullname" placeholder="Enter your Full-Name">
      </div>

      <div class="form-group">
        <label for="mobile">Mobile-No:</label>
        <input id="mobile" type="text" name="mobile" placeholder="Enter your Mobile-Number">
      </div>



      <!-- Submit Button -->
      <div class="form-group">
        <button type="submit" class="submit-btn">Register</button>
      </div>
    </form>
  </div>

  





</body>
</html>


