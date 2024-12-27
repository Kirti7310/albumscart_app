<?php

include 'db.php';



?>
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
  <title>Music Album</title>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

  <!--Jquery CDN-->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="css/custom-styles.css"> -->

  
</head>
<body>
<h1 class="head-main1" style="color:black;" ><?php echo $display_msg; ?></h1>

<?php

include 'header.php';


?>

<h2 class="main-head"> TOP 5 SONGS OF <?php echo date('Y');?> </h2>
<div class="album-container">
  <?php

  
  $sql = "select album_name ,song_title from albums";
  $result = $conn->query($sql);
  // print_r($result);

  if($result->num_rows>0)
  {
    //  print_r($row=$result->fetch_assoc());exit;
    while($row=$result->fetch_assoc())
    {

      echo "<div class='album'>";
      echo "<h3>".$row['album_name']."</h3>";
      echo "<p> Song:".$row['song_title']."</p>";
      echo "</div>";
    }
   
  }
  else 
  {
    echo "<p>No albums!</p>";
  }


  
  ?>

</div>



<div class="categori">
  <?php 
include 'categories.php';


?>
</div>



<?php
$conn->close();

?>




</body>
<script>

$(document).ready(function()
{

 

  function fetchheader()
  {
    $.ajax(
      {
        url:'fetch_header.php',
        method:'GET',
        dataType:'json',
        success:function(response)
        {console.log(response);
          
               $('#dynamic_header').html(response.header_title);
        },
        error:function()
        {
          console.log("error");
        }

      }
    )};

  setInterval(fetchheader,3000);
  fetchheader();

  var $albums = $('.album');
 
  function animateAlbums() {
        var $albums = $('.album'); 
        
        $albums.each(function() {
            $(this).fadeTo(500, 0)  
                .fadeTo(500, 1);    
        });
    }

    $albums.on('click',function()
  {
    animateAlbums();

  })




});



  </script>
</html>