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
<h1 class="head-main1" style="color:black;" ><?php echo $display_msg; ?></h1>

<?php


 include 'header.php';
include 'db.php';

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



$sqlcategories  = "select song_name,album_name,genre,rate,rating,category_id from music_categories";
$songs =[];
$categoriesres=$conn->query($sqlcategories);

if($categoriesres->num_rows > 0)
{
     while($row=$categoriesres->fetch_assoc())
     {
      $songs[]=$row;
     }
}else
{
  $songs=[];
}








?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include jQuery Confirm CSS (if using npm, install via npm) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<!-- Include jQuery Confirm JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

  <style>

.modal {
  display: none; 
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7); 
  padding-top: 60px;
  display: flex;
  justify-content: center;
  align-items: center; 
  overflow: auto; 
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px; 
  max-height: 80%; 
  overflow-y: auto; 
  text-align: center;
}

.modal-content img {
  width: 100%;
  height: auto;
  max-height: 400px; 
  max-width: 100%; 
  margin-bottom: 15px;
}
.cart-main{
  padding: 10px;
  background-color: rgb(250, 250, 250);
  color: black;
  transition: transform 0.5s ease-out;
}
.cart-main:hover{
  padding: 10px;
  background-color: rgb(250, 250, 250);
  color: black;
  /* transform: scale(0.5); */
}
.wish-main{
  padding: 10px;
  background-color: rgb(190, 181, 184);
  color: black;
  transition: transform 0.5s ease-out;

}
.wish-main:hover{
  padding: 10px;
  background-color: rgb(190, 181, 184);
  color: black;
  /* transform: scale(0.5); */
}

.modal-content h2 {
  font-size: 1.5em;
  margin: 10px 0;
  color: white;
}

.modal-content p {
  font-size: 1.2em;
  color: white;

}

.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 0;
  right: 15px;
  text-decoration: none;
  background-color: transparent;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}



.container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
  /* background-color:rgb(251, 247, 247); */
}

.category-box {
  width: 185px;
  border: 1px solid #ddd;
  border-radius: 10px;
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
  padding: 15px;
  transition: transform 0.2s, box-shadow 0.2s;
}

.category-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}


.category-box .album-cover {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}


.category-box .song-title {
  font-size: 1.1em;
  font-weight: bold;
  color: #333333;
  margin: 5px 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}


.category-box .genre {
  font-size: 0.9em;
  color: #666666;
  margin: 5px 0;
}

.category-box .rating {
  font-size: 1.2em;
  color: #ffd700; 
  margin: 10px 0;
}

.category-box .rate {
  font-size: 0.9em;
  color: #666666;
  margin: 5px 0;
}

.end-main{
  padding: 25px;
  color: #fefefe;
  background-color: #888;
  transition: transform 0.4s ease-in,background-color 0.4s ease-in;
  text-decoration: none;
  border-radius: 8px;
}
.end-main:hover{
  transform: translateX(-2px);
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  background-color: #000;
  color: white;
}

</style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include jQuery (only once) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include jQuery Confirm CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<!-- Include jQuery Confirm JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>




<script>

$(document).ready(function()
{
  $('#songModal').fadeOut();

  $('.album-cover').on('click',function()
{

  // var songname = $(this).data('song-name');
  // var genre = $(this).data('genre');
  // var rating = $(this).data('rating');
  // var albumCover = $(this).data('album_name'); 


  var songname = $(this).data('song-name');
        var genre = $(this).data('genre');
        var rating = $(this).data('rating');
        var rate =$(this).data('song-rate');
        var albumname = $(this).data('album-name');
        console.log(albumname);

  $('#modalSongTitle').text(songname);
  $('#modalGenre').text(genre);
  $('#modalGenre').text(rate);

  var  ratingStars='';
  for (var i = 0; i < Math.round(rating); i++) {
            ratingStars += '★';
        }
        for (var i = 0; i < (5 - Math.round(rating)); i++) {
            ratingStars += '☆';
        }

        $('#modalRating').text(ratingStars);

  $('#modalAlbumCover').attr("src",albumname);

  $('#songModal').fadeIn();
  



});


$('.cart-main').on('click',function()
{

  var songname = $(this).data('song-name');
        var genre = $(this).data('genre');
        var rating = $(this).data('rating');
        var rate =$(this).data('song-rate');
        
        console.log(songname);

  $.ajax(
    {
      url:'Auth_cart.php',
      method:'POST',
      dataType:'json',
      data:
      {
        song_name : songname,
        rating:rating,
        rate:rate,
        genre:genre,
       
      },
      success:function(response)
      {
          const catobj = response;
          console.log(catobj);
        
            // console.log(response.song_name);
         

          $.alert(
            {
              title:'Success',
              content:'ADDED TO CART!',
              buttons:
              {
                ok:{
                  text:'OK',
                  action:function()
                  {

                    window.location.href = 'cart_page.php';
                  }
                }
              }
            });
          },
          error:function()
          {
            console.error("AJAX Error: ");

          }
    }
  )




});



$('.wish-main').on('click',function()
{

  var songname = $(this).data('song-name');
  var genre = $(this).data('genre');
  var rating = $(this).data('rating');

  $.ajax(
    {
      url:'Auth_wish.php',
      method:'POST',
      dataType:'json',
      data:
      {
        song_name:songname,
        genre:genre,
        rating:rating
      },
      success:function(response)
      {
        console.log(response.song_name);

        $.alert(
          {
            title:'Success',
            content:'Added To WishList!',
            buttons:
            {
              ok:
              {
                text:'OK',
                action:function()
                {
                  window.location.href="wish_page.php";
                }
              }
            }






          });




      },
      error:function()
          {
            console.error("AJAX Error: ");

          }



    });






});




$('.close').on('click',function()
{
  $('#songModal').fadeOut();
})

$(document).on('keydown',function(event)
{
  if(event.key ==='Escape')
{
  $('#songModal').fadeOut();
}
  
});








});







</script>



</head>


<body>
  
<!-- <header>
    <h1 class="head-main1" style="color:black;"><?php echo $display_msg; ?></h1>
</header> -->
<div id="songModal" class="modal">
  <div class="model-content">
    <span class="close">&times</span>
    <div class="modal-details">
    
    <img id="modalAlbumCover" src="" alt="Album Cover" />
            <h2 id="modalSongTitle"></h2>
            <p id="modalGenre"></p>
            <p id="modalRating"></p>
  </div>
  </div>


</div>



<div class="container">
  <?php foreach ($songs as $songnames): ?>
    <div class="category-box">

                                    
     
      <img src="<?php echo htmlspecialchars($songnames['album_name']); ?>" 
           alt="<?php echo htmlspecialchars($songnames['song_name']); ?>" 
           class="album-cover"
           
           data-song-name="<?php echo $songnames['song_name']; ?>" 
                                    data-genre="<?php echo $songnames['genre']; ?>" 
                                    data-rating="<?php echo $songnames['rating']; ?>" 
                                    data-album-name="<?php echo $songnames['album_name']; ?>"
                                    data-song-rate="<?php echo $songnames['rate'];?>">
           
           
           
           
           
      
    
      <h6 class="song-title"><?php echo htmlspecialchars($songnames['song_name']); ?></h6>
      
      
      <p class="genre"><?php echo htmlspecialchars($songnames['genre']); ?></p>
      <p class="rate"><i class="fa-solid fa-indian-rupee-sign"></i> : <?php echo htmlspecialchars($songnames['rate']); ?></p>

      
      <p class="rating">
        <?php echo str_repeat('★', round($songnames['rating'])) . str_repeat('☆', 5 - round($songnames['rating'])); ?>
     
      </p>
      <button class="cart-main"
      data-song-name="<?php echo $songnames['song_name']; ?>" 
              data-genre="<?php echo $songnames['genre']; ?>"
              data-song-rate="<?php echo $songnames['rate'];?>" 
              data-rating="<?php echo $songnames['rating']; ?>">
      
      Add to Cart</button>
      <button class="wish-main"
      data-song-name="<?php echo $songnames['song_name']; ?>" 
              data-genre="<?php echo $songnames['genre']; ?>" 
              data-song-rate="<?php echo $songnames['rate'];?>"
              data-rating="<?php echo $songnames['rating']; ?>">
      
      Add to WishList</button>

    </div>
  <?php endforeach; ?>
  
</div>

<a class="end-main" href="index.php">HOME-PAGE</a>




</body>
</html>