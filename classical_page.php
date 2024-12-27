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

<?php

include 'db.php';



?>
<h1 class="head-main1" style="color:black;" ><?php echo $display_msg; ?></h1>
<?php 
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<style>
.song-wrapper
{
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
}


.song-container
{
  display:flex;
  flex-wrap: wrap;
  background-color: rgba(188, 179, 179, 0.1);
  padding: 15px;
  margin:10px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 200px;
  justify-content: center;
  transition: transform 0.5s ease-out, box-shadow 0.5s ease-out;
}
.song-container:hover
{
  transform:translateX(5px);
  box-shadow: 0 4px 8px rgba(81, 75, 75, 0.84);
}
.song-container img{
  width:150px;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-right: 20px;
}
.song-info{

  display: flex;
  flex-direction: column;
  justify-content: center;

}
.go-back
{
  padding: 20px;
  background-color: rgba(81, 75, 75, 0.84);
  color: white;
  width: 200px;
  transition: transform 0.5s ease-in;
  text-decoration: none;

}
.go-back:hover
{
  transform: translateX(4px);
  box-shadow: 0px 4px 8px rgba(188, 179, 179, 0.1);
  padding: 20px;
  background-color: rgba(81, 75, 75, 0.84);
  color: white;
  
}
</style>

<?php 

if(isset($_GET['category_id']))
{

$category_id=$_GET['category_id'];
// print_r($category_id);exit;


$sqlclassical = 
"SELECT song_name,genre,album_name,rating,rate,category_id from
 music_categories INNER JOIN categories_link ON music_categories.category_id = categories_link.c_id 
 where music_categories.category_id =  $category_id;";


$sqlclassicalresult = $conn->query($sqlclassical);

if($sqlclassicalresult->num_rows>0)
{
  echo "<div class='song-wrapper'>";

  while($row=$sqlclassicalresult->fetch_assoc())
  {
    echo "<div class='song-container'>";
        
    echo "<img src='" . $row['album_name'] . "' alt='" . $row['song_name'] . "' />";
    
    echo "<div class='song-info'>";
    echo "<p><strong>Song Name:</strong> " . $row['song_name'] . "</p>";
    echo "<p><strong>Genre:</strong> " . $row['genre'] . "</p>";
    echo "<p><strong>Rating:</strong> " . str_repeat('★', $row['rating']).str_repeat('☆',5-$row['rating']) . "</p>";
    echo "<p><strong><i class='fa-solid fa-indian-rupee-sign'></i></strong> " . $row['rate'] . "</p>";
    echo "</div>"; 
    
    echo "</div>";
       
  }
  echo "</div>";

}
else{
  echo "no records found";
}



}

?>

<div>
  <a href="index.php" Button class="go-back">HOME-PAGE</Button></a>
</div>
</head>
</html>



