<?php
if (isset($_POST['itemqty']) && isset($_POST['totalcost'])) {
    $itemqty = (int) $_POST['itemqty'];
    $totalcost = (float) $_POST['totalcost'];  

    if ($itemqty >= 0 && $totalcost >= 0) {
        echo json_encode(['itemqty' => $itemqty, 'totalcost' => $totalcost]);  
    } else {
        echo json_encode(['error' => 'Invalid quantity or total cost']);
    }
} else {
    echo json_encode(['error' => 'Missing data']);
}
?> 