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

  // Get ID
  $product->cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : die();
  $product->load = isset($_GET['limit']) ? $_GET['limit'] : die();
  if(isset($_GET['subcat_id'])){
    $product->subcat_id = isset($_GET['subcat_id']) ? $_GET['subcat_id'] : die();
  }


  // product read query
  $result = $product->read();
  
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
            'Product_Price'=>$Product_Price,
            'Category_name'=>$Category_Name,
            'Subcategory_name'=>$Subcategory_Name,
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