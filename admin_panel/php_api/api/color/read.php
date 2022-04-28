<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../../config/Database.php';
  include_once '../../models/color.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate color object
  $color = new Color($db);

  $color->Category_ID=isset($_GET['cid'])?$_GET['cid']:die();
  // color read query
  $result = $color->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any color
  if($num > 0) {
        // Cat array
        $col_arr = array();
        $col_arr['main'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $col_item = array(
            'ID' => $ID,
            'Product_Color' => $Product_Color,
            'Color_Code'=>$Color_Code
          );
          $result2 = $color->total_item($ID);
          while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
    
            $product_item = array(
              'total_item' => $total_item
            );
    
            // Push to "data"
            $new_data = array_merge($col_item, $product_item);
            array_push($col_arr['main'], $new_data);
          }
          // Push to "data"
          // array_push($col_arr['data'], $col_item);
        }

        // Turn to JSON & output
        echo json_encode($col_arr);

  } else {
        // No color
        echo json_encode(
          array('message' => 'No color Found')
        );
  }