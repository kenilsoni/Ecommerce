<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/wishlist.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate wishlist object
$wishlist = new Wishlist($db);

// Get ID

if (isset($_GET['user_id']) && isset($_GET['product_id'])) {
    // wishlist read query
    $check=$wishlist->check_wishlist($_GET['user_id'], $_GET['product_id']);
    while($row3 = $check->fetch(PDO::FETCH_ASSOC)) {
        $count=$row3['count'];
    }
    if($count>0){
        echo json_encode(
            array('message' => false)
        );
    }else{
        $result = $wishlist->add_wishlist($_GET['user_id'], $_GET['product_id']);
        // Get row count
        $num = $result->rowCount();
    
        // Check if any wishlist
        // if ($num > 0) {
            echo json_encode(
                array('message' => true)
            );
        // } 
    }

    
}
