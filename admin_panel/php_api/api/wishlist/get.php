<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../../config/Database.php';
  include_once '../../models/wishlist.php';
  include_once '../../models/product.php';
  include_once '../user/auth.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $product = new Product($db);
  // Instantiate wishlist object
  $wishlist = new Wishlist($db);

  // Get ID
  
  if(isset($_GET['user_id'])){
    $wishlist->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
      // wishlist read query
    $result = $wishlist->get_id();
      // Get row count
  $num = $result->rowCount();
  }




  


  // Check if any wishlist
  if($num > 0) {
        // wishlist array
        $wishlist_arr = array();
        $wishlist_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
           $Product_ID=$row['Product_ID'];
           $pdt_detail=$wishlist->get_detail($Product_ID);
        
        
        while($row2 = $pdt_detail->fetch(PDO::FETCH_ASSOC)) {
          extract($row2);

          $wishlist_item1 = array(
            'ID' => $ID,
            'Product_Name' => $Product_Name,
            'Product_Description'=>$Product_Description,
            'Product_Quantity'=>$Product_Quantity,
            'IsTrending'=>$IsTrending,
            'Subcategory_ID'=>$Subcategory_ID,
            'Category_ID'=>$Category_ID,
            'Product_Quantity'=>$Product_Quantity,
            'Product_Color_ID'=>$Product_Color_ID,
            'Size_Name'=>$Product_Size,
            'Product_Price'=>$Product_Price,
            'Category_name'=>$Category_Name,
            'Subcategory_name'=>$Subcategory_Name,
            'Color_name'=>$Product_Color,
            'Size_id' => $size_id,
            'price_id' => $Price_ID,
            
          );
          $result2 = $product->getsingle_image($ID);
          while($row3 = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row3);
  
            $wishlist_item2 = array(
              'Image_path'=>$Image_Path
            );
  
            // Push to "data"
            $newdata=array_merge($wishlist_item1, $wishlist_item2);
          }
          // Push to "data"
          array_push($wishlist_arr['data'], $newdata);
         
        }
      }
       
        // echo "<pre>";
        // print_r($wishlist_arr);
        // Turn to JSON & output
        echo json_encode($wishlist_arr); 

  } else {
        // No wishlist
        echo json_encode(
          array('message' => 'No wishlist Found')
        );
  }
  