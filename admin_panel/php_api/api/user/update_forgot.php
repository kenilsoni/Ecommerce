<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/user.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// Get raw posted data

if (isset($_GET['email']) && isset($_GET['password'])) {
    $epassword= openssl_encrypt($_GET['password'], "AES-128-ECB", "skp1506");
  $result = $user->update_password_email($_GET['email'],$epassword);
  $num=$result->rowCount();
  if($num>0){
    echo json_encode(["message" => true]);
  }else{
    echo json_encode(["message" => false]);
  }
 
} else {
 
    echo json_encode(["message" => false]);
  
}
