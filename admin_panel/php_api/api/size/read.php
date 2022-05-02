<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../../config/Database.php';
  include_once '../../models/size.php';
  include_once '../user/auth.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate size object
  $size = new Size($db);

  
  $size->Category_ID=isset($_GET['cid'])?$_GET['cid']:die();
  // size read query
  $result = $size->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any size
  if($num > 0) {
        // size array
        $size_arr = array();
        $size_arr['main'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $size_item = array(
            'ID' => $ID,
            'Product_Size' => $Product_Size
            
          );
          $result2 = $size->total_item($ID);
          while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
    
            $product_item = array(
              'total_item' => $total_item
            );
    
            // Push to "data"
            $new_data = array_merge($size_item, $product_item);
            array_push($size_arr['main'], $new_data);
          }

          // Push to "data"
          // array_push($size_arr['data'], $size_item);
        }

        // Turn to JSON & output
        echo json_encode($size_arr);

  } else {
        // No size
        echo json_encode(
          array('message' => 'No size Found')
        );
  }