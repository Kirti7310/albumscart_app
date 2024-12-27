<?php

if(isset($_POST['category_id']))
{
    $category_id = intval($_POST['category_id']);
    echo json_encode(['category_id' => $category_id]);


}
else{
    echo json_encode(['error'=>"Invalid category id"]);
}

?>