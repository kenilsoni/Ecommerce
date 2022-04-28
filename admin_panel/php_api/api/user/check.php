<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/user.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// Get username
if (isset($_GET['username'])) {
    $user->UserName = isset($_GET['username']) ? $_GET['username'] : die();
    $result = $user->check();
    $num = $result->rowCount();
} else if (isset($_GET['email'])) {
    $user->Email = isset($_GET['email']) ? $_GET['email'] : die();
    $result = $user->check_email();
    $num = $result->rowCount();
}


// Check if any product
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $count = $row['count'];
    }
    if ($count > 0) {
        echo json_encode(
            array('message' => 'user is  exist', 'success' => true)
        );
    } else {
        echo json_encode(
            array('message' => 'username is not exist', 'success' => false)
        );
    }
} else {
    echo json_encode(
        array('message' => 'something went wrong', 'success' => false)
    );
}
