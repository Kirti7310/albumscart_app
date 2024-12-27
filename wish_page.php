<?php
include 'db.php';
include 'header.php';

session_start();

if(!isset($_SESSION['song_name']) && !isset($_SESSION['genre']) && isset($_POST['rate']) && !isset($_SESSION['rating']))
{

$error_message = "Cant Add to Cart! Try Again :|";
header('catg_page.php');
exit();







}


$song_name = $_SESSION['song_name'];
$song_genre = $_SESSION['genre'];
$rate=$_SESSION['rate'];
$song_rating = $_SESSION['rating'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>

  .cart-container
  {
    display: grid;
    margin:10px;
    padding: 20px;
    font-style: normal;
    font-size: 1.1em;
    font-family: sans-serif;
    width:10%;
    height: 10%;
    text-align: center;
    border-radius: 8px;
    transition: transform 0.5s ease-in-out;
    border: 1px solid grey;
  }


  .cart-container:hover
  {
    transform: scale(1,1);
    background-color: rgb(248, 242, 242);
    box-shadow: 0px 4px 12px  rgb(170, 168, 168);
  }

  .fa-minus:hover{
    
    color: red;
  }

  .fa-plus:hover{
    color: red;
  }

  .modal-cart-cont{
    display: none;
    padding:60px;
    justify-content: center;
    position: fixed;
    background-color:linear-gradient(to-botton,rgba(229, 160, 160, 0.2),rgb(236, 132, 132));
    display:flexbox;
    overflow:auto;
    z-index: 2;
    align-items: center;
  }


  .close{
    position: absolute;
    font-size: 1.5em;
  }
  .close:hover,
  .close:focus
  {
    color: red;
    cursor:pointer;

  }

  #buy-btn{
  padding: 25px;
  color: #fefefe;
  background-color: #888;
  transition: transform 0.4s ease-in,background-color 0.4s ease-in;
  text-decoration: none;
  border-radius: 8px;
  
}
#buy-btn:hover{
  transform: translateX(-2px);
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  background-color: #000;
  color: white;
}




</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function()
{
  $('.modal-cart-cont').fadeOut();

  let itemqty = 0 ; 
  let qty = 0;
  let rate = parseFloat($('.ratecost').text());
  let newrate =0;
 

  


   $('.fa-minus').on('click',function()
  {
      if(itemqty>0)
      {
        itemqty-=1;
        let totalcost = rate * itemqty;

      
      console.log(totalcost);

      update(itemqty,totalcost);

      
      }


  });
  $('.fa-plus').on('click',function()
  {
      itemqty += 1;
      let totalcost = rate * itemqty;
      console.log(totalcost);

      update(itemqty,totalcost);


  });

  function update(itemqty,rate)
  {
    $.ajax(
        {
          
          url : 'cart_items.php',
          method:'POST',
          dataType:'json',
          data:
          {
           itemqty:itemqty,
           rate:rate
          },
          success:function(response)
          {
            qty = response.itemqty;
            newrate = response.rate;

            $('#qty').text(response.itemqty || itemqty);
            $('#ratenew').text(response.rate || rate);

          },
          error:function()
          {
            console.log("error");
          }

        });
  }


  $('.cart-container').on('click',function()
{

      var song_name = $(this).data('song-name');
      var genre = $(this).data('genre');
      var rate = $(this).data('rate');

      $('.modal-cart-cont').fadeIn();
      if(qty !== undefined && rate!==undefined)
      {
        console.log(qty);
        $('#qty').text(qty);
        $('#ratenew').text(rate);
      }


      


         




});

$('#buy-btn').on('click',function()
{
  console.log("jkikkk");
  window.location.href='shop_end.php';

});


$(document).on('keydown',function(event)
{

     if(event.key === 'Escape')
     {
      $('.modal-cart-cont').fadeOut();

     }

});










});

</script>



<body>
  

<div class="cart-container">
<div><i class="fa-solid fa-minus"></i> </div>


<p ><?php echo $song_name?></p>
<p><?php echo $song_genre?></p>
<p id="rate"><i class="fa-solid fa-indian-rupee-sign"> : </i><?php echo $rate?></p>
<p hidden class="ratecost"><?php echo $rate ?></p>
<p><?php echo str_repeat('<i class="fa-solid fa-star"></i>',floor($song_rating)). str_repeat('<i class="fa-solid fa-star"></i>',5-floor($song_rating));?></p>
<div><i class="fa-solid fa-plus"></i></div>


</div>


<div class="modal-cart-cont"

data-song-name="<?php echo $songnames['song_name']; ?>" 
              data-genre="<?php echo $songnames['genre']; ?>" 
              data-rate="<?php echo $songnames['rate']; ?>" 
              data-rating="<?php echo $songnames['rating']; ?>">
              <span class="close">&times</span>
      
  <h3><?php echo $song_name?></h3>
  <h3><?php echo $song_genre?></h3>
  <i class="fa-solid fa-indian-rupee-sign"> : </i><h3 id="ratenew"></h3>
  <h3>Qty:</h3><h3 id="qty">0</h3>
  <p hidden></p>
<button id="buy-btn">BUY NOW</button></a>
  
</div>






</body>
</html>








