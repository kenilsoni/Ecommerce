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

  $product->order = isset($_GET['order']) ? $_GET['order'] : die();
  $product->Category_ID = isset($_GET['cid']) ? $_GET['cid'] : die();
  $product->load = isset($_GET['load']) ? $_GET['load'] : die();

  if(isset($_GET['clr_id']) && isset($_GET['subcat_arr'])){
    $product->Product_Color_ID = isset($_GET['clr_id']) ? $_GET['clr_id'] : die();
    $product->Subcategory_ID = isset($_GET['subcat_arr']) ? $_GET['subcat_arr'] : die();
    if(isset($_GET['size_arr'])){
      $product->Product_Size = isset($_GET['size_arr']) ? $_GET['size_arr'] : die();
      $result = $product->order_size();
      $num = $result->rowCount();
    }else{

       // product read query
   $result = $product->order_clr();
   $num = $result->rowCount();
    }
   

  }else if(isset($_GET['size_array'])){
    $product->Subcategory_ID = isset($_GET['subcat_arr']) ? $_GET['subcat_arr'] : die();
    $product->Product_Size = isset($_GET['size_array']) ? $_GET['size_array'] : die();
    $result = $product->order_cat();
   $num = $result->rowCount();

  }
  else{

// echo $product->load;
  // product read query
  $result = $product->get_order();
  
  // Get row count
  $num = $result->rowCount();
  }
  

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