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

if (isset($_GET['cid'])) {
  if (isset($_GET['cid']) == 'search') {
    // size read query
    $result = $size->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any size
    if ($num > 0) {
      // size array
      $size_arr = array();
      $size_arr['main'] = array();

      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $size_item = array(
          'ID' => $ID,
          'Product_Size' => $Product_Size

        );
        $result2 = $size->total_item1($ID);
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
      }
      // Turn to JSON & output
      echo json_encode($size_arr);
    } else {
      // No size
      echo json_encode(
        array('message' => 'No size Found')
      );
    }
  } else {
    $size->Category_ID = $_GET['cid'];
    // size read query
    $result = $size->read();
    // Get row count
    $num = $result->rowCount();
    // Check if any size
    if ($num > 0) {
      // size array
      $size_arr = array();
      $size_arr['main'] = array();
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
      }
      // Turn to JSON & output
      echo json_encode($size_arr);
    } else {
      // No size
      echo json_encode(
        array('message' => 'No size Found')
      );
    }
  }
} else if (isset($_GET['product_id'])) {
  $size->Product_ID = $_GET['product_id'];
  $result = $size->sizeby_product();
  $num = $result->rowCount();
  if ($num > 0) {
    $size_arr = array();
    $size_arr['main'] = array();
    $size_item = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $size_item = $Product_Size;
    }
    $data = explode(",", $size_item);
    $size_all = array();
    $size_final = array();
    foreach ($data as $val) {
      $result = $size->read_single($val);
      $num = $result->rowCount();
      if ($num > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $size_all = array("size" => $Product_Size, "id" => $ID);
          array_push($size_final, $size_all);
        }
      }
    }
    echo json_encode($size_final);
  } else {
    // No size
    echo json_encode(
      array('message' => 'No size Found')
    );
  }
}
