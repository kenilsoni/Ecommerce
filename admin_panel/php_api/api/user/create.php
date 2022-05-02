<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: *');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/user.php';
  include_once '../user/auth.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $user = new User($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if($data){
    $user->UserName = $data->username;
    $user->FirstName = $data->firstname;
    $user->LastName = $data->lastname;
    $user->Email = $data->email;
    $user->Password=password_hash($data->password,PASSWORD_DEFAULT);
    $user->Mobile = $data->mobile;
    $user->Phone = $data->phone;
    $user->Gender = $data->gender;
    if($data-> intrest !== ''){
      $user->Intrest = $data-> intrest;
    }else{
      $user->Intrest = 'NULL';
    }
    // Create user
  if($user->create()) {
    echo json_encode(
      array('message' => 'user Created','success'=>true)
    );
  } else {
    echo json_encode(
      array('message' => 'user Not Created','success'=>false)
    );
  }
  }
  



  