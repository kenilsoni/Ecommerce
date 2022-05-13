<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/contact.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate contact object
$contact = new Contact($db);
$data = json_decode(file_get_contents("php://input"));
if ($data) {
    $contact->name = $data->name;
    $contact->email = $data->email;
    $contact->subject = $data->subject;
    $contact->message = $data->message;
    // contact read query
    $result = $contact->add_contact();


    // Check if any contact
    if ($result) {
        // contact array
        // Turn to JSON & output
        echo json_encode(array('message' => true));
    } else {
        // No contact
        echo json_encode(
            array('message' => false)
        );
    }
}
