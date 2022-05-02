<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers:* ");


// require "../../JWT/vendor/autoload.php";

// use \Firebase\JWT\JWT;

include_once '../../config/Database.php';
include_once '../../models/JWT.php';
include_once '../../models/user.php';
include_once '../../models/city.php';
include_once '../../models/state.php';
include_once '../../models/country.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$user = new User($db);
$jwt = new JWTtoken($db);

// Get username
if (isset($_GET['username']) && isset($_GET['password'])) {
    $user->UserName = isset($_GET['username']) ? $_GET['username'] : die();
    $user->Password = isset($_GET['password']) ? $_GET['password'] : die();
    $result = $user->check_login();
    $num = $result->rowCount();

    // Check if any product
    if ($num > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $firstname = $row['FirstName'];
            $ID = $row['ID'];
            $Password = $row['Password'];
        }
        if (password_verify($user->Password, $Password)) {
            $secret_key = "skp1506";
            $issuer_claim = "localhost";
            $audience_claim = "user_auth";
            $issuedat_claim = time(); // time issued 
            $notbefore_claim = $issuedat_claim + 10;
            $expire_claim = $issuedat_claim + 300;

            $access_token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $ID,
                    "firstName" => $firstname
                )
            );

            $refresh_token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => 600,
                "data" => array(
                    "id" => $ID,
                    "firstName" => $firstname
                )
            );

            $access_jwtValue = $jwt->create_token($access_token, $secret_key, 'HS512');
            $refresh_jwtValue = $jwt->create_token($refresh_token, $secret_key, 'HS512');
            echo json_encode(
                array(
                    "success" => true,
                    "access_token" => $access_jwtValue,
                    "refresh_token" => $refresh_jwtValue,
                    "expiry" => $expire_claim,
                    "firstName" => $firstname,
                    "id" => $ID,
                )
            );
        } else {
            echo json_encode(
                array('message' => 'Invalid Password', 'success' => false)
            );
        }
    } else {
        echo json_encode(
            array('message' => 'User Is Not Exist', 'success' => false)
        );
    }
}
