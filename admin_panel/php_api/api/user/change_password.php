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
    $result = $user->check_password($data->user_id);
    $num = $result->rowCount();
    if ($num > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $db_password = openssl_decrypt($row['Password'], "AES-128-ECB", "skp1506");
            if ($db_password === $data->password) {
                $new_password = openssl_encrypt($data->new_password, "AES-128-ECB", "skp1506");
                $add = $user->update_password($data->user_id, $new_password);
                if ($add) {
                    echo json_encode(
                        array('success' => true)
                    );
                }
            } else {
                echo json_encode(
                    array('success' => false)
                );
            }
        }
    }
}
