<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/state.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate state object
$state = new State($db);
if (isset($_GET['id'])) {
  // state read query
  $result = $state->read($_GET['id']);

  // Get row count
  $num = $result->rowCount();

  // Check if any state
  if ($num > 0) {
    // state array
    $state_arr = array();
    $state_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $state_item = array(
        'ID' => $ID,
        'State' => $State,
        'Country_ID' => $Country_ID
      );

      // Push to "data"
      array_push($state_arr['data'], $state_item);
    }

    // Turn to JSON & output
    echo json_encode($state_arr);
  } else {
    // No state
    echo json_encode(
      array('message' => 'No state Found')
    );
  }
}
