<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/user.php';
include_once '../../models/city.php';
include_once '../../models/state.php';
include_once '../../models/country.php';

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

// //build the headers
// $headers = ['alg'=>'HS256','typ'=>'JWT'];
// $headers_encoded = base64url_encode(json_encode($headers));

// //build the payload
// $payload = ['sub'=>'1234567890','name'=>'abcd', 'admin'=>true];
// $payload_encoded = base64url_encode(json_encode($payload));

// //build the signature
// $key = 'secret';
// $signature = hash_hmac('sha256',"$headers_encoded.$payload_encoded",$key,true);
// $signature_encoded = base64url_encode($signature);

// //build and return the token
// $token = "$headers_encoded.$payload_encoded.$signature_encoded";
// echo $token;






















// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);

// Get username
if (isset($_GET['username']) && isset($_GET['password'])) {
    $user->UserName = isset($_GET['username']) ? $_GET['username'] : die();
    $user->Password = isset($_GET['password']) ? $_GET['password'] : die();

    // $city = new City($db);
    // $state = new State($db);
    // $country = new Country($db);
    // $for_city = $city->read();
    // $for_state = $state->read();
    // $for_country = $country->read();



    $result = $user->check_login();
    $num = $result->rowCount();

    // Check if any product
if ($num > 0) {
    // $user_detail=array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $firstname=$row['firstname'];
        // extract($row);
        // $user_detail=array(
        //     'count' => $count,
        //     'FirstName' => $FirstName,
        //     'LastName' => $LastName,
        //     'Email' => $Email,
        //     'Phone' => $Phone,
        //     'Mobile' => $Mobile,
        //     'Password' => $Password,
        //     'Gender' => $Gender,
        //     'ID' => $ID,
        // );
       
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



