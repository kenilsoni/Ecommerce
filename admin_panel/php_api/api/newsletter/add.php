<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/user.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// Get username
if (isset($_GET['email'])) {
    $result = $user->add_nl($_GET['email']);
    // Check if any product
    if ($result) {

        echo json_encode(
            array('success' => true)
        );
    } else {
        echo json_encode(
            array('success' => false)
        );
    }
}
