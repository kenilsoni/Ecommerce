<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: *');
require './stripe-php-master/init.php';
require '../../../models/stripe.php';
$stripe = new \Stripe\StripeClient(
    $stripe_secret
);
// Set API key 
\Stripe\Stripe::setApiKey($stripe_secret);
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
