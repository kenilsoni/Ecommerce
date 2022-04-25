<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/user.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// Get username
if (isset($_GET['username']) && isset($_GET['password'])) {
    $user->UserName = isset($_GET['username']) ? $_GET['username'] : die();
    $user->Password = isset($_GET['password']) ? $_GET['password'] : die();
    $result = $user->check_login();
    $num = $result->rowCount();

    // Check if any product
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $count = $row['count'];
        $firstname = $row['FirstName'];
    }
    if ($count > 0) {
       
        echo json_encode(
            array('name' => $firstname, 'success' => true)
        );
    } else {
        echo json_encode(
            array('message' => 'user is not exist', 'success' => false)
        );
    }
} else {
    echo json_encode(
        array('message' => 'something went wrong', 'success' => false)
    );
}
}



