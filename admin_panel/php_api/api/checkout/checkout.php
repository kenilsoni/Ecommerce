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
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);
if ($jsonObj) {
  $line_items_array = [];
  foreach ($jsonObj as $obj) {
    $line_items_array[] = array(
      'price_data' => [
        'product_data' => [
          'name' =>  $obj->Product_Name,
          'description' => 'Nice Product',
        ],
        'unit_amount' => $obj->currency == 'INR' ? $obj->Unit_Price * 100 : $obj->Unit_Price,
        'currency' => $obj->currency,
      ],
      'quantity' => $obj->Quantity,
      'tax_rates' => [$obj->tax]
    );
  }
  if (count($line_items_array) > 0) {
    $checkout_session = \Stripe\Checkout\Session::create([
      'line_items' =>  $line_items_array,
      'mode' => 'payment',
      'payment_method_types' => ['card'],
      'success_url' => 'http://localhost:4200/status/{CHECKOUT_SESSION_ID}',
      'cancel_url' => 'http://localhost:4200/status/id=false',
      'allow_promotion_codes' => true
    ]);
    echo json_encode($checkout_session->id);
  }
}
