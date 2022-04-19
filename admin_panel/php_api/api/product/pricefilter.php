<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate product object
  $product = new Product($db);

  $product->Product_Size = isset($_GET['size_id']) ? $_GET['size_id'] : die();
  $product->Category_ID = isset($_GET['cid']) ? $_GET['cid'] : die();
  // product read query
  $result = $product->price_filter();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any product
  if($num > 0) {
        // product array
        $product_arr = array();
        $product_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $product_item = array(
            'ID' => $ID,
            'Product_Name' => $Product_Name,
            'Product_Description'=>$Product_Description,
            'Product_Quantity'=>$Product_Quantity,
            'IsTrending'=>$IsTrending,
            'Subcategory_ID'=>$Subcategory_ID,
            'Category_ID'=>$Category_ID,
            'Product_Quantity'=>$Product_Quantity,
            'Product_Color_ID'=>$Product_Color_ID,
            'Product_Size'=>$Product_Size,
            'Product_Price'=>$Product_Price
            
          );

          // Push to "data"
          array_push($product_arr['data'], $product_item);
        }

        // Turn to JSON & output
        echo json_encode($product_arr);

  } else {
        // No product
        echo json_encode(
          array('message' => 'No product Found')
        );
  }