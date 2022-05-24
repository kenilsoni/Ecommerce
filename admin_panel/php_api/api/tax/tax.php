<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/tax.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate tax object
$tax = new Tax($db);
if (isset($_GET['id'])) {
    // tax read query
    $result = $tax->state($_GET['id']);
    // Get row count
    $num = $result->rowCount();
    // Check if any tax
    if ($num > 0) {
        // tax array
        $tax_arr = array();
        $tax_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $tax_item = array(
                'tax' => $tax_percent,
                'State_ID' => $State_ID,
                'State' => $State
            );
            // Push to "data"
            array_push($tax_arr['data'], $tax_item);
        }
        // Turn to JSON & output
        echo json_encode($tax_arr);
    } else {
        // No tax
        echo json_encode(
            array('message' => 'No tax Found')
        );
    }
} else if (isset($_GET['ship_id'])) {
    // tax read query
    $result = $tax->getshipping($_GET['ship_id']);
    // Get row count
    $num = $result->rowCount();
    // Check if any tax
    if ($num > 0) {
        // tax array
        $tax_arr = array();
        $tax_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $tax_item = array(
                'tax' => $tax_stripe,
            );
            // Push to "data"
            array_push($tax_arr['data'], $tax_item);
        }
        // Turn to JSON & output
        echo json_encode($tax_arr);
    } else {
        // No tax
        echo json_encode(
            array('message' => 'No tax Found')
        );
    }
} else {
    // tax read query
    $result = $tax->country();
    // Get row count
    $num = $result->rowCount();

    // Check if any tax
    if ($num > 0) {
        // tax array
        $tax_arr = array();
        $tax_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $tax_item = array(
                'Country_ID' => $Country_ID,
                'Country' => $Country,
            );
            // Push to "data"
            array_push($tax_arr['data'], $tax_item);
        }
        // Turn to JSON & output
        echo json_encode($tax_arr);
    } else {
        // No tax
        echo json_encode(
            array('message' => 'No tax Found')
        );
    }
}
