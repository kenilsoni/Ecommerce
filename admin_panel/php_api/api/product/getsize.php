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
  $product->load = isset($_GET['limit']) ? $_GET['limit'] : die();
  // product read query
  $result = $product->get_size();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any product
  if($num > 0) {
        // product array
        $product_arr = array();
        $product_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $product_item1 = array(
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
            'Subcategory_name'=>$Subcategory_Name
            
          );
          $result2 = $product->getsingle_image($ID);
          while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
  
            $product_item2 = array(
              'Image_path'=>$Image_Path
            );
  
            // Push to "data"
            $newdata=array_merge($product_item1, $product_item2);
          }
          // Push to "data"
          array_push($product_arr['data'], $newdata);
         
        }

        // Turn to JSON & output
        echo json_encode($product_arr);

  } else {
        // No product
        echo json_encode(
          array('message' => 'No product Found')
        );
  }