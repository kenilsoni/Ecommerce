<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/subcategory.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate subcategory object
  $subcategory = new Subcategory($db);

  // subcategory read query
  $result = $subcategory->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any subcategories
  if($num > 0) {
        // subcat array
        $subcat_arr = array();
        $subcat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $subcat_item = array(
            'ID' => $ID,
            'Subcategory_Name' => $Subcategory_Name,
            'Subcategory_desc'=>$Subcategory_desc,
            'Category_ID'=>$Category_ID
          );

          // Push to "data"
          array_push($subcat_arr['data'], $subcat_item);
        }

        // Turn to JSON & output
        echo json_encode($subcat_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }