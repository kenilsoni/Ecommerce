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
if (isset($_GET['ID'])) {
    $result = $user->get_user($_GET['ID']);
    $address = $user->get_useraddress($_GET['ID']);
    $num = $result->rowCount();
    // Check if any product
    if ($num > 0) {
        $user_data = array();
        $address_data = array();
        $address_billing = array();
        $address_shipping = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $plain_password = openssl_decrypt($Password, "AES-128-ECB", 'skp1506');
            $user_data = array(
                'ID' => $ID,
                'UserName' => $UserName,
                'FirstName' => $FirstName,
                'LastName' => $LastName,
                'Email' => $Email,
                'Password' => $plain_password,
                'Gender' => $Gender,
                'Phone' => $Phone,
                'Mobile' => $Mobile,
                'Intrest' => $Intrest
            );
        }
        while ($row = $address->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            if ($Address_Type == 'Billing') {
                $address_billing = array(
                    'Street' => $Street,
                    'Country_ID' => $Country_ID,
                    'FirstName' => $FirstName,
                    'State_ID' => $State_ID,
                    'City_ID' => $City_ID,
                    'Password' => $plain_password,
                    'Address_Type' => $Address_Type,
                    'Phone' => $Phone,
                    'Mobile' => $Mobile,
                    'Intrest' => $Intrest
                );
            } else if ($Address_Type == 'Shipping') {
                $address_shipping = array(
                    'Street' => $Street,
                    'Country_ID' => $Country_ID,
                    'FirstName' => $FirstName,
                    'State_ID' => $State_ID,
                    'City_ID' => $City_ID,
                    'Password' => $plain_password,
                    'Address_Type' => $Address_Type,
                    'Phone' => $Phone,
                    'Mobile' => $Mobile,
                    'Intrest' => $Intrest
                );
            }
        }
        echo json_encode(
            array('user_data' => $user_data, 'address_shipping' => $address_shipping, 'address_billing' => $address_billing, 'success' => true)
        );
    } else {
        echo json_encode(
            array('data' => $user_data, 'success' => false)
        );
    }
}
