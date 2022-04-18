<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/size.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate size object
  $size = new Size($db);

  // size read query
  $result = $size->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any size
  if($num > 0) {
        // size array
        $size_arr = array();
        $size_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $size_item = array(
            'ID' => $ID,
            'Product_Size' => $Product_Size
            
          );

          // Push to "data"
          array_push($size_arr['data'], $size_item);
        }

        // Turn to JSON & output
        echo json_encode($size_arr);

  } else {
        // No size
        echo json_encode(
          array('message' => 'No size Found')
        );
  }