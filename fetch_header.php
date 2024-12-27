<?php

include 'db.php';

$sql = "Select header_title from albums ORDER BY RAND() LIMIT 1";
$result =$conn->query($sql);
$response = [];
//print_r($sql);exit;
if($result->num_rows>0)
{
  $row=$result->fetch_assoc();
  $response['header_title'] = $row['header_title'];

}
else{
  $response['header_title'] = "Enjoy Amazing Discounts on Albums!";
}


echo json_encode($response);







?>