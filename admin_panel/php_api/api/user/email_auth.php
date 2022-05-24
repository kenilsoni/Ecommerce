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
if (isset($_GET['check_otp']) && isset($_GET['email'])) {
  $result = $user->check_otp($_GET['email'], $_GET['check_otp']);
  $num=$result->rowCount();
  if($num>0){
    $datetime_check = $user->select_datetime($_GET['email'], $_GET['check_otp']);
    while ($row = $datetime_check->fetch(PDO::FETCH_ASSOC)) {
      $dtime = $row['Created_At'];
    }
    date_default_timezone_set("Asia/Calcutta");
    $abc = new DateTime($dtime);
    $abcd = new DateTime();
    $diff = $abc->diff($abcd);
    $time_difference = $diff->i;
    $time_hour = $diff->h;
    if ($time_difference < 1 && $time_hour==0) {
      $modify = $user->modify_otp($_GET['email'], $_GET['check_otp']);
      echo json_encode(["message" => true]);
    }else if($time_difference > 1){
      $modify = $user->modify_otp($_GET['email'], $_GET['check_otp']);
      echo json_encode(["message" => false]);
    } else {
      echo json_encode(["message" => false]);
    }
  }else{
    echo json_encode(["message" => false]);
  }
} else {
  $random = rand(10000, 99999);
  $send_mail = $user->send_otp($_GET['email'], $random);
  if ($send_mail) {
    $chek_extra = $user->check_extra_otp($_GET['email']);
    while ($row = $chek_extra->fetch(PDO::FETCH_ASSOC)) {
      $count = $row['count'];
    }
    if ($count > 0) {
      $user->modify_otp($_GET['email']);
      $result = $user->add_otp($_GET['email'], $random);
      $num = $result->rowCount();
      if ($num > 0) {
        echo json_encode(["message" => true]);
      } else {
        echo json_encode(["message" => false]);
      }
    } else {
      $result = $user->add_otp($_GET['email'], $random);
      $num = $result->rowCount();
      if ($num > 0) {
        echo json_encode(["message" => true]);
      } else {
        echo json_encode(["message" => false]);
      }
    }
  } else {
    echo json_encode(["message" => false]);
  }
}
