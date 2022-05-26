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
    if (!empty($_GET['pid']) && !empty($_GET['load'])) {
        $review = array();
        $average_arr = array();
        // review read query
        $result = $product->get_review($_GET['pid'], $_GET['load']);
        $result2 = $product->get_avg($_GET['pid']);
        // Get row count
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $data_db = array(
                'review' => $Product_Review,
                'fullname' => $FullName,
                'rate' => $Product_Rate,
                'date' => $Created_At
            );
            
            array_push($review, $data_db);
        }
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $data_db2 = array(
                'avg' => $average
            );
            array_push($average_arr,$data_db2);
        }
      
        echo json_encode(
            array('message' => $review,'average' => $average_arr)
        );
    }  else {
        // No review
        echo json_encode(
            array('message' => false)
        );
    }
}

