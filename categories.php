

<?php
$sql = "select c.c_name,c.c_id,cl.c_link from categories c LEFT JOIN categories_link cl on c.c_id=cl.c_id order by c.c_name;";

$result = $conn->query($sql);

if($result->num_rows > 0): 
?>
  <link rel="stylesheet" type="text/css" href="css/categories.css">

  <div class="category-list"> 
    <?php 
    
    while($row = $result->fetch_assoc()):
      $category_name = $row['c_name'];
      $category_link = $row['c_link'];
      $category_id=$row['c_id'];
    ?>
      <div class="category-item">
        <a class="category-link" data-link="<?php echo $category_link?>" data-category_id="<?php echo $category_id;?>" href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
      </div>
    <?php endwhile; ?>
  </div> 

<?php
endif;
?>

<script>

$(document).ready(function()
{

  $('.category-link').on('click',function(e)
{
  e.preventDefault();
  let category_link =$(this).data('link');
  let category_id =$(this).data('category_id');
  console.log(category_link); 
  console.log(category_id);


     $.ajax(
      {
        url:'auth_categories.php',
        method:'POST',
        dataType:'json',
        data:{
          category_id:category_id
        },
        success:function(response)
        {
          if (response.category_id) {
          // After AJAX success, redirect to the category link
          window.location.href = category_link + '?category_id=' + response.category_id;  // Pass category_id as query parameter
        } else {
          console.log("Invalid category ID response");
        }
          console.log(response.category_id);
        },
        error:function()
        {
          console.log("error");
        }
      });
});
});




</script>


<footer class="footer-main">
  <div class="footer-contect">
  <p>&copy; <?php echo date("Y"); ?> Music.Corp. All rights reserved.</p>

  <p>For queries contact us: +91 9878786590 | Panjim - North-Goa,India 403001</p>
</div>

<div>
<div class="social-icons">
    <a href="https://twitter.com" target="_blank">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="https://facebook.com" target="_blank">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://instagram.com" target="_blank">
      <i class="fab fa-instagram"></i>
    </a>
  </div>
</div>
</footer>


