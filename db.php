<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "music_db";


$conn = new mysqli($host,$username,$password,$db_name);

if($conn->connect_error)
{
  die("Connection Unsuccessfull!!". $conn->connect_error);
}


