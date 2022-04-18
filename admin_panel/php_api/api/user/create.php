<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/user.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $user = new User($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  $user->UserName = $data->UserName;
  $user->FirstName = $data->FirstName;
  $user->LastName = $data->LastName;
  $user->Email = $data->Email;
  $user->Password = $data->Password;
  $user->Mobile = $data->Mobile;
  $user->Phone = $data->Phone;
  $user->Gender = $data->Gender;
  $user->Intrest = $data-> Intrest;


  // Create user
  if($user->create()) {
    echo json_encode(
      array('message' => 'user Created')
    );
  } else {
    echo json_encode(
      array('message' => 'user Not Created')
    );
  }