<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/country.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate country object
  $country = new Country($db);

  // country read query
  $result = $country->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any country
  if($num > 0) {
        // country array
        $country_arr = array();
        $country_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $country_item = array(
            'ID' => $ID,
            'Country' => $Country
          );

          // Push to "data"
          array_push($country_arr['data'], $country_item);
        }

        // Turn to JSON & output
        echo json_encode($country_arr);

  } else {
        // No country
        echo json_encode(
          array('message' => 'No country Found')
        );
  }