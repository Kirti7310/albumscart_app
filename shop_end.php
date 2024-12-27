<?php

session_start();


if(isset($_POST['song_name'])  && isset($_POST['song_genre'])  && isset($_POST['totalcost']) && isset($_POST['qty']))

{

  $_SESSION['song_name'] = $_POST['song_name'];
  $_SESSION['song_genre'] = $_POST['song_genre'];
  $_SESSION['totalcost'] = intval($_POST['totalcost']);
  $_SESSION['qty'] = intval($_POST['qty']);

    echo json_encode(['status' => 'success']);
  exit();
 
}

if(!isset($_POST['song_name']))
{
  $item = 1 ;
  echo json_encode(['item'=> $item]);
  exit();
}

?>


