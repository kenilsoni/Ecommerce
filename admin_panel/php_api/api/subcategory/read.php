<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/subcategory.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate subcategory object
$subcategory = new Subcategory($db);



// getsubcategory by categoryid
if (isset($_GET['cid'])) {
  if($_GET['cid']==='search'){

    $result = $subcategory->read_all();
  
  
    //Get row count
    $num = $result->rowCount();
  
    // Check if any state
    if ($num > 0) {
      // state array
      $subcat_arr = array();
      $subcat_arr['main'] = array();
  
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $state_item = array(
          'ID' => $ID,
          'Subcategory_Name' => $Subcategory_Name,
          'Subcategory_desc' => $Subcategory_desc,
        );
        $result2 = $subcategory->total_item($ID,$Category_ID);
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
  
          $subcategory_item = array(
            'total_item' => $total_item,
            'Category_Name' => $Category_Name
          );
  
          // Push to "data"
          $new_data = array_merge($subcategory_item, $state_item);
          array_push($subcat_arr['main'], $new_data);
        }
      }
  
      // echo '<pre>';print_r($subcat_arr); echo '</pre>';
      // Turn to JSON & output
      echo json_encode($subcat_arr);
    } else {
      // No state
      echo json_encode(
        array('message' => 'No category Found')
      );
    }
  }else{
    $subcategory->Category_ID = $_GET['cid'];
    $result = $subcategory->read_single();
  
  
    //Get row count
    $num = $result->rowCount();
  
    // Check if any state
    if ($num > 0) {
      // state array
      $subcat_arr = array();
      $subcat_arr['main'] = array();
  
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $state_item = array(
          'ID' => $ID,
          'Subcategory_Name' => $Subcategory_Name,
          'Subcategory_desc' => $Subcategory_desc,
        );
        $result2 = $subcategory->total_item2($ID);
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
  
          $subcategory_item = array(
            'total_item' => $total_item
          );
  
          // Push to "data"
          $new_data = array_merge($subcategory_item, $state_item);
          array_push($subcat_arr['main'], $new_data);
        }
      }
  
      // echo '<pre>';print_r($subcat_arr); echo '</pre>';
      // Turn to JSON & output
      echo json_encode($subcat_arr);
    } else {
      // No state
      echo json_encode(
        array('message' => 'No category Found')
      );
    }
  }
 
} else {
  // subcategory read query
  $result = $subcategory->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any subcategories
  if ($num > 0) {
    // subcat array
    $subcat_arr = array();
    $subcat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $subcat_item = array(
        'ID' => $ID,
        'Subcategory_Name' => $Subcategory_Name,
        'Subcategory_desc' => $Subcategory_desc,
        'Category_ID' => $Category_ID
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
}
