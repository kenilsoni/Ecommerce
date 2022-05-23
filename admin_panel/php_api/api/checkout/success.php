<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: *');
require './stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient(
    'sk_test_51KxNo9SJ5Q50OIO5VnFcjevn1wRbzTfYFTuxvZ05BIf1jMdKOQVNiMtQKzE21DsCZqQkSDYu8UQXo4K8cMIOub1j00ehZHuEns'
);
// Set API key 
\Stripe\Stripe::setApiKey("sk_test_51KxNo9SJ5Q50OIO5VnFcjevn1wRbzTfYFTuxvZ05BIf1jMdKOQVNiMtQKzE21DsCZqQkSDYu8UQXo4K8cMIOub1j00ehZHuEns");
if (isset($_GET['cs_id'])) {
    try{
        $id = $stripe->checkout->sessions->retrieve(
            $_GET['cs_id'],
            []
        );
        echo json_encode($id);
    }catch(Exception $e){
        echo json_encode(false);
    }
  
}
