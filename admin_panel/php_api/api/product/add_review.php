<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/product.php';
include_once '../user/auth.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate review object
$product = new Product($db);
// Get ID
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['userid']) && !empty($_GET['review']) && !empty($_GET['rate']) && !empty($_GET['pid'])) {
        // review read query
        $result = $product->add_review($_GET['userid'], $_GET['review'], $_GET['rate'], $_GET['pid']);
        // Get row count
        if ($result > 0) {
            echo json_encode(
                array('message' => true)
            );
        } else {
            // No review
            echo json_encode(
                array('message' => false)
            );
        }
    }  else {
        // No review
        echo json_encode(
            array('message' => false)
        );
    }
}
