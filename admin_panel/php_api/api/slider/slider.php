<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/slider.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate slider object
$slider = new Slider($db);

  $result = $slider->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any slider
  if ($num > 0) {
    // slider array
    $slider_arr = array();
    $slider_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $slider_item = array(
        'Image_Path' => $Image_Path
      );

      // Push to "data"
      array_push($slider_arr['data'], $slider_item);
    }

    // Turn to JSON & output
    echo json_encode($slider_arr);
  } else {
    // No slider
    echo json_encode(
      array('data' => 'false')
    );
  }

