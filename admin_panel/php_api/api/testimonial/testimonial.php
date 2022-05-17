<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/testimonial.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate testimonial object
$testimonial = new Testimonial($db);

  $result = $testimonial->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any testimonial
  if ($num > 0) {
    // testimonial array
    $testimonial_arr = array();
    $testimonial_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $testimonial_item = array(
        'Name' => $Name,
        'Description' => $Description,
        'Designation' => $Designation,
        'Image_Path' => $Image_Path
      );

      // Push to "data"
      array_push($testimonial_arr['data'], $testimonial_item);
    }

    // Turn to JSON & output
    echo json_encode($testimonial_arr);
  } else {
    // No testimonial
    echo json_encode(
      array('data' => false)
    );
  }

