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
        // review read query
        $result = $product->get_review($_GET['pid'], $_GET['load']);
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
        echo json_encode(
            array('message' => $review)
        );
    } else if (!empty($_GET['pid']) && !empty($_GET['userid'])) {
        $review = array();
        // review read query
        $result = $product->check_review($_GET['pid'], $_GET['userid']);
        $num = $result->rowCount();
        if ($num > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $data_db = array(
                    'review' => $Product_Review,
                    'rate' => $Product_Rate
                );
                array_push($review, $data_db);
            }
            echo json_encode(
                array('message' => $review)
            );
        } else {
            echo json_encode(
                array('message' => false)
            );
        }
    } else {
        // No review
        echo json_encode(
            array('message' => false)
        );
    }
}
