



<?php
include 'db.php';
include 'header.php';

session_start();



if(!isset($_SESSION['cart']))
{
  $error_message = "Cant Add to the cart!";
  header('Location:catg_page.php');
  exit;

}
if(isset($_SESSION['cart']))
{
  $cartItems = $_SESSION['cart'];
  foreach($cartItems as $items)
  {
    $song_name = $items['song_name'];
    $song_genre = $items['genre'];
    $rate=$items['rate'];
    $song_rating=$items['rating'];

  }
 
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>


.class-conta{
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
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
  $('.modal-cart-cont').hide();  


   $('.fa-minus').on('click',function()
  {
    let container = $(this).closest('.cart-container');
    let itemqty = parseInt(container.data('itemqty') || 0);
    let rate = parseFloat(container.data('rate'));
    
      if(itemqty>0)
      {
        itemqty-=1;
        let totalcost = rate * itemqty;
        container.data('itemqty',itemqty);
        container.data('totalcost',totalcost);
        console.log(totalcost);
        update(container, itemqty,totalcost);

      
      }


  });
  $('.fa-plus').on('click',function()
  {
    let container = $(this).closest('.cart-container');
    let itemqty = parseInt(container.data('itemqty') || 0);
    let rate = parseFloat(container.data('rate'));
    
      itemqty += 1;
    let totalcost = rate * itemqty;
    container.data('itemqty', itemqty);
    container.data('totalcost',totalcost);
    console.log(totalcost);
    update(container, itemqty, totalcost);


  });

  function update(container,itemqty,totalcost)
  {
    $.ajax(
        {
          
          url : 'cart_items.php',
          method:'POST',
          dataType:'json',
          data:
          {
           itemqty:itemqty,
          totalcost:totalcost
          },
          success:function(response)
          {
           
            container.find('.qty').text(response.itemqty || itemqty);
            container.find('.ratenew').text(response.totalcost || totalcost);
            container.data('totalcost',response.totalcost || totalcost);

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
      var totalcost =$(this).data('totalcost');



      var modal =$('.modal-cart-cont').filter(function()
    {
      return(

        
        $(this).data('song-name') === song_name &&
        $(this).data('genre') === genre &&
        $(this).data('rate') == rate
        
      );
      

    }) ;
    $('.modal-cart-cont').hide();
    if (modal.length > 0) {
    modal.fadeIn();
  } else {
   
    console.error("No matching modal found.");
  }
  $('.qty').text($(this).data('itemqty'));
  console.log(totalcost);
  $('.ratenew').text(totalcost);

      


         




});

$('.buy-btn').on('click',function()
{

  let container = $(this).closest('.modal-cart-cont');
  let song_name = container.data('song-name');
  let song_genre = container.data('genre');
  let totalcost = container.find('.ratenew').text();
  let qty = container.find('.qty').text();
 

  $.ajax(
    {

      url:'shop_end.php',
      method:'POST',
      dataType:'json',
      data:
      {
        song_name:song_name,
        song_genre:song_genre,
        totalcost:totalcost,
        qty:qty
      },
      success:function(response)
      {
        console.log(response);
        console.log(response.status);
        console.log(response);  // Log the full response object
            if (response && response.status === 'success') {
                window.location.href = 'new_end.php';  // Redirect after success
            } else {
                console.log('Status not success');
            }
        
      },
      error:function()
      {
        console.log('error');
      }


    });




  // window.location.href='shop_end.php';

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
  <div class="class-conta">
<?php foreach($cartItems as $items):?> 


  
<div class="cart-container"
data-song-name="<?php echo $items['song_name']; ?>" 
              data-genre="<?php echo $items['genre']; ?>" 
              data-rate="<?php echo $items['rate']; ?>" 
              data-rating="<?php echo $items['rating']; ?>">
<div><i class="fa-solid fa-minus"></i> </div>



<p ><?php echo $items['song_name']?></p>
<p><?php echo $items['genre']?></p>
<p id="rate"><i class="fa-solid fa-indian-rupee-sign"> : </i><?php echo $items['rate']?></p>
<p hidden class="ratecost"><?php echo $items['rate'] ?></p>
<p><?php echo str_repeat('<i class="fa-solid fa-star"></i>',floor($items['rating'])). str_repeat('<i class="fa-solid fa-star"></i>',5-floor($items['rating']));?></p>
<div><i class="fa-solid fa-plus"></i></div> 


</div>

<?php endforeach;?>
</div>
<?php  foreach($cartItems as $items):?>
  <div class="modal-cart-cont"
     data-song-name="<?php echo $items['song_name']; ?>" 
     data-genre="<?php echo $items['genre']; ?>" 
     data-rate="<?php echo $items['rate']; ?>" 
     data-itemqty="0">
    <h3><?php echo $items['song_name']; ?></h3>
    <h3><?php echo $items['genre']; ?></h3>
    <i class="fa-solid fa-indian-rupee-sign"> : </i><h3 class="ratenew"></h3>
    <h3 >Qty:</h3><h3 class="qty">0</h3>
    <button class="buy-btn"
    
    
    >BUY NOW</button>
</div>
<?php endforeach;?>





</body>
</html>








