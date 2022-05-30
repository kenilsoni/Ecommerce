<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
include_once '../../config/Database.php';
include_once '../../models/cart.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate cart object
$cart = new Cart($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user_id']) && isset($_GET['payment_id'])  && isset($_GET['total'])) {
        $cart->User_ID = $_GET['user_id'];
        $result = $cart->getcart_final($_GET['user_id']);
        // Get row count
        $num = $result->rowCount();
        // Check if any categories
        if ($num > 0) {
            $Cart_arr = array();
            $Cart_arr['product'] = array();
            $Cart_arr['color'] = array();
            $Cart_arr['size'] = array();
            $Cart_arr['quantity'] = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($Cart_arr['product'], $Product_ID);
                array_push($Cart_arr['color'], $Color_ID);
                array_push($Cart_arr['size'], $Size_ID);
                array_push($Cart_arr['quantity'], $Quantity);
                $result2 = $cart->check_quantity($Product_ID);
                while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                    $cart->decrease_quantity((int)$row2['Product_Quantity'] - (int)$Quantity, $Product_ID);
                }
            }
            $oid = rand(10000, 99999);
            $add_data = $cart->place_order(implode(",", $Cart_arr['product']), implode(",", $Cart_arr['color']), implode(",", $Cart_arr['size']), implode(",", $Cart_arr['quantity']), $oid, $_GET['payment_id'], $_GET['total']);
            if ($add_data) {
                echo json_encode(
                    array(['data' => true, 'order_id' => $oid])
                );
            } else {
                echo json_encode(
                    false
                );
            }
        } else {
            echo json_encode(
                false
            );
        }
    }
}
