<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
include_once '../../config/Database.php';
include_once '../../models/user.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$user = new User($db);
// Get user
$result = $user->get_about();
// Check if any product
if (count($result) > 0) {
    echo json_encode(
        array('success' => $result)
    );
} else {
    echo json_encode(
        array('success' => false)
    );
}
