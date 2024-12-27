<?php


session_start();

if(!isset($_POST['cart']))
{
    $_POST['cart']=[];
}



  if (isset($_POST['song_name']) && isset($_POST['genre']) && isset($_POST['rate']) && isset($_POST['rating'])) {





$item = [

  'song_name'=>$_POST['song_name'],
  'genre'=>$_POST['genre'],
  'rate'=>$_POST['rate'],
  'rating'=>$_POST['rating'],

];

$_SESSION['cart'][] = $item;


echo json_encode($_SESSION['cart']);

  }
  else{
    echo json_encode(['error'=>"invalid data"]);
  }














?>