<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/city.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate city object
  $city = new City($db);

  // city read query
  $result = $city->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any city
  if($num > 0) {
        // city array
        $city_arr = array();
        $city_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $city_item = array(
            'ID' => $ID,
            'City' => $City,
            'State_ID'=>$State_ID,
            'Country_ID'=>$Country_ID
          );

          // Push to "data"
          array_push($city_arr['data'], $city_item);
        }

        // Turn to JSON & output
        echo json_encode($city_arr);

  } else {
        // No city
        echo json_encode(
          array('message' => 'No city Found')
        );
  }