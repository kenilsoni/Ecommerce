<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/order.php';
include_once '../user/auth.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate order object
$order = new Order($db);
// Get ID
$userid = isset($_GET['user_id']) ? $_GET['user_id'] : die();
$orderid = isset($_GET['load']) ? $_GET['load'] : die();
// order read query
$result = $order->read($userid, $orderid);
// Get row count
$num = $result->rowCount();
// Check if any order
if ($num > 0) {
    $final_as = [];
    // order array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $order_item = array(
            'Order_ID' => $row['Order_ID'],
            'Status' => $row['Status'],
            'Created_At' => $row['Created_At'],
            'Total' => $row['Total']
        );
        $success = $order->get_orderid($row['Order_ID'],"");

        if (count($success) > 0) {
            $final_arr = [];
            $final_arr['detail'] = [];
            $final_arr['name'] = [];
            $final_arr['clr'] = [];
            $final_arr['size'] = [];
            $final_arr['qty'] = [];
            foreach ($success as $val) {
                $productid = explode(",", $val['Product_ID']);
                $qty = explode(",", $val['Quantity']);
                $clr = explode(",", $val['Color']);
                $size = explode(",", $val['Size']);
            }

            array_push($final_arr['detail'], $order_item);


            foreach ($productid as $pid) {
                $pdt = $order->get_details_pdt($pid);
                array_push($final_arr['name'], $pdt);
            }
            foreach ($clr as $cid) {
                $clrnew = $order->get_clr($cid);
                array_push($final_arr['clr'], $clrnew);
            }
            foreach ($size as $sid) {
                $sizenew = $order->get_size($sid);
                array_push($final_arr['size'], $sizenew);
            }
            foreach ($qty as $q) {
                array_push($final_arr['qty'], $q);
            }
            $final[] = array_merge($final_as, $final_arr);
        }
    }
    echo json_encode(
        $final
    );
} else {
    // No order
    echo json_encode(
        array('message' => 'No order Found')
    );
}
