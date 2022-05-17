<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header("Access-Control-Allow-Headers: *");
  header('Access-Control-Allow-Methods: *');
  include_once '../../config/Database.php';
  include_once '../../models/cart.php';
  include_once '../user/auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate cart object
  $cart = new Cart($db);
  $data = json_decode(file_get_contents("php://input"));
    // print_r($data);die();
  if(isset($data->user_id)){
    $cart->User_ID=$data->user_id;
    $cart->Color_ID=$data->Product_Color_ID;
    $cart->Product_Name=$data->Product_Name;
    $cart->Size_ID=$data->Size_id;
    $cart->Quantity=$data->Product_Quantity;
    $cart->Product_Image=$data->Image_path;
    $cart->Product_ID=$data->ID;
    $cart->Unit_Price=$data->Product_Price;
    $cart->Total_Amount=$data->Product_Price;
    $cart->price_id=$data->price_id;

    $check=$cart->check_item();
    $count = $check->rowCount();

    if($count>0){
      

      while($row = $check->fetch(PDO::FETCH_ASSOC)) {
        // extract($row);
        $quantity=$row['Quantity'];
        $unit_price=$row['Unit_Price'];
        
        

        // $cart_item = array(
        //   'ID' => $ID,
        //   'Product_ID' => $Product_ID,
        //   'Product_Name' => $Product_Name,
        //   'Quantity' => $Quantity,
        //   'Color_ID' => $Color_ID,
        //   'Size_ID' => $Size_ID,
        //   'Total_Amount' => $Total_Amount,
        //   'Unit_Price' => $Unit_Price,
        //   'User_ID' => $User_ID,
        //   'Color_Name' => $Product_Color,
        //   'Size_Name' => $Product_Size,
        //   'Product_Image'=>$Product_Image
        // );

        // Push to "data"
        // array_push($Cart_arr['data'], $cart_item);
      }
      $quantity+=1;
      $total=$quantity*$unit_price;
      // echo $quantity.'dd';
      // echo $total;
      $result = $cart->update_quantity($quantity,$total);
    }else{
      $result = $cart->add_item();
    }
    
  }


  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
    echo json_encode(
        array('message' =>true)
      );

  } else {

        echo json_encode(
          array('message' =>false)
        );
  }