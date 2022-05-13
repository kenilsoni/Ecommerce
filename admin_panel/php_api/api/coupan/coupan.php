<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  include_once '../../config/Database.php';
  include_once '../../models/coupan.php';
  include_once '../user/auth.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate coupan object
  $coupan = new Coupan($db);

  // coupan read query
  $result = $coupan->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any coupan
  if($num > 0) {
        // coupan array
        $coupan_arr = array();
        $coupan_arr['available'] = array();
        $coupan_arr['expiry'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $date1 = date("Y-m-d"); 
          $date2 = $Expiry; 
          $timestamp1 = strtotime($date1); 
          $timestamp2 = strtotime($date2); 
          if ($timestamp1 > $timestamp2){
            $coupan_item = array(
                'ID' => $Coupan_ID,
                'discount' => $Discount,
                'expiry'=>$Expiry
              );
    
              // Push to "data"
              array_push($coupan_arr['expiry'], $coupan_item);
          
          }else{
            $coupan_item = array(
                'ID' => $Coupan_ID,
                'discount' => $Discount,
                'expiry'=>$Expiry
              );
    
              // Push to "data"
              array_push($coupan_arr['available'], $coupan_item);
          }
           
          
        }

        // Turn to JSON & output
        echo json_encode($coupan_arr);

  } else {
        // No coupan
        echo json_encode(
          array('message' => 'No coupan Found')
        );
  }