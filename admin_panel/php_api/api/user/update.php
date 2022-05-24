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
$data = json_decode(file_get_contents("php://input"));
//   print_r($data);die();
if ($data) {
    $user->ID = $data->id;
    $user->UserName = $data->username;
    $user->Password = openssl_encrypt($data->password, "AES-128-ECB", "skp1506");
    $user->FirstName = $data->firstname;
    $user->LastName = $data->lastname;
    $user->Email = $data->email;
    $user->Mobile = $data->mobile;
    $user->Phone = $data->phone;
    $user->Gender = $data->gender;

    if ($data->billing->country_bill !== "" && $data->billing->state_bill !== "" &&  $data->billing->city_bill !== "" && $data->billing->street_bill !== "") {
        $user->country_bill = $data->billing->country_bill;
        $user->state_bill = $data->billing->state_bill;
        $user->city_bill = $data->billing->city_bill;
        $user->street_bill = $data->billing->street_bill;
        $user->address_type = 'Billing';

        $result1 = $user->check_address_billing($user->ID);
        $num = $result1->rowCount();
        if ($num > 0) {
            while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
                $count = $row['count'];
            }
            if ($count > 0) {
                //update
                $user->update_address_billing($user->ID);
            } else {
                //create
                $user->create_address_billing($user->ID);
            }
        }
    }
    if ($data->shipping->country_ship != "" && $data->shipping->state_ship != "" &&  $data->shipping->city_ship != "" && $data->shipping->street_ship != "") {
        $user->country_ship = $data->shipping->country_ship;
        $user->city_ship = $data->shipping->city_ship;
        $user->state_ship = $data->shipping->state_ship;
        $user->street_ship = $data->shipping->street_ship;
        $user->address_type = 'Shipping';
        $result2 = $user->check_address_shipping($user->ID);
        $num = $result2->rowCount();
        if ($num > 0) {
            while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                $count = $row['count'];
                // echo $count;
            }
            if ($count > 0) {
                //update
                $user->update_address_shipping($user->ID);
            } else {
                //create
                $user->create_address_shipping($user->ID);
            }
        }
    }

    // if($data-> intrest !== ''){
    //   $user->Intrest = $data-> intrest;
    // }else{
    //   $user->Intrest = 'NULL';
    // }
    // Create user
    if ($user->update()) {
        echo json_encode(
            array('message' => 'user updated', 'success' => true)
        );
    } else {
        echo json_encode(
            array('message' => 'user Not updated', 'success' => false)
        );
    }
}
