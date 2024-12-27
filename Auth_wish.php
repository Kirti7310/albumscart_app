<?php


session_start();



  if (isset($_POST['song_name']) && isset($_POST['genre']) && isset($_POST['rating'])) {





$wish = [

  'song_name'=>$_POST['song_name'],
  'genre'=>$_POST['genre'],
  'rating'=>$_POST['rating'],

];

$_SESSION['song_name'] = $_POST['song_name'];
$_SESSION['genre'] = $_POST['genre'];
$_SESSION['rating'] = $_POST['rating'];


echo json_encode($wish);




  }
  else{
    echo json_encode(['error'=>"invalid data"]);
  }














?>