<?php

session_start();

if(isset($_SESSION['song_name']) && isset($_SESSION['song_genre']) && isset($_SESSION['totalcost']) && isset($_SESSION['qty']))
{
  if(!isset($_SESSION['shoppingcart']))
  {
    $_SESSION['shoppingcart']=[];

  }


    $items = 
    [
      'song_name' => $_SESSION['song_name'],
      'song_genre'=> $_SESSION['song_genre'],
      'totalcost'=>$_SESSION['totalcost'],
      'qty'=>$_SESSION['qty'],
    ];

    $itemsnew = false;
    foreach($_SESSION['shoppingcart'] as $new)
    {
      if(($new['song_name'] === $items['song_name']) && ($new['song_genre'] === $items['song_genre']) && 
      ($new['totalcost'] === $items['totalcost'])) 
      {
        $itemsnew = true;
        break;
      }
    }

    if(!$itemsnew)
    {
      $_SESSION['shoppingcart'][]=$items;
    }

    $itemcat = $_SESSION['shoppingcart'];


  }








?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
   .container-shop {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
   }

   .sub-container
   {
    background-color: rgb(216, 209, 209);
    padding: 40px;
    gap: 20px;
    transition: box-shadow 0.5s ease-in;
   }
   .sub-container:hover
   {
    box-shadow: 0px 4px 8px rgb(106, 96, 96);
   }

   .Home-page{

      margin-top: 20px;
      padding : 40px;
      text-align: center;
      font-size: 30px;
      color: rgb(106, 96, 96);
      transition: color 0.5s ease-in, background-color 0.5s ease-out;


   }
   
   .Home-page:hover
   {
    color: rgb(14, 4, 4);
    background-color: rgb(177, 173, 173);
  }

  .Home-page a
   {
    text-decoration: none;
  }
  .clickend
  {
    padding: 20px;
    background-color: rgb(177, 173, 173);
    margin-top: 20px;
  }

   
  </style>

  <script>
$(document).ready(function() {
   

    $('.clickend').on('click',function()
  {
    let cumulativeTotal = 0; 
    
    $('.song_totalcost').each(function() {
        let total = parseFloat($(this).data('totalcost')) || 0; 
        cumulativeTotal += total; 
    });
    console.log(cumulativeTotal);

    $('.end_class').text(cumulativeTotal);





  })

});
  </script>
</head>
<body>
<div class="container-shop">
  <?php if (isset($itemsnew)): ?>
      <?php foreach ($itemcat as $newitems): ?>
          <div class="container-shop">
              <div class="sub-container">
                  Album Song Name : <p class="song_name"><?php echo htmlspecialchars($newitems['song_name']); ?> </p>
                  Album Song Genre : <p class="song_genre"><?php echo htmlspecialchars($newitems['song_genre']); ?></p>
                  <i class="fa-solid fa-indian-rupee-sign"></i> : 
                  <p class="song_totalcost" data-totalcost="<?php echo htmlspecialchars($newitems['totalcost']); ?>">
                  <?php echo htmlspecialchars($newitems['totalcost']); ?>
              </p>
                                Total Qty :<p class="song_qty"><?php echo htmlspecialchars($newitems['qty']); ?></p>
              </div>
              </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>




<div>
  <button class="clickend">Click here </button>
</div>


<div class="Home-page">
  <a href="cart_page.php"> <i class="fa-solid fa-house"></i>
  Back To Home</a>
  </div>



  <div class="Home-page">
  <i class="fa-solid fa-indian-rupee-sign"></i>
  <p>Total Cost:</p>
  <p class="end_class">0</p>
</div>


</body>
</html>