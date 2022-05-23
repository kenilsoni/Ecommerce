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
        'unit_amount' => $obj->currency=='INR'? $obj->Unit_Price*100: $obj->Unit_Price,
        'currency' => $obj->currency,
    ],
    'quantity' => $obj->Quantity,
    'tax_rates' => [$obj->tax]
);
  }
  // print_r($line_items_array);die();
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


// Retrieve JSON from POST body 
// $line_items_array[] = array(
//   'price' =>  $obj->price_id,
//   'quantity' => $obj->Quantity,
//   'tax_rates' => [$obj->tax],
// );
// // echo json_encode($jsonObj);
// $token = $jsonObj->id; // Token ID
// if($token){
//    //add customer to stripe
//    $customer = \Stripe\Customer::create(array(
//     'name' =>  $jsonObj->email,
//     'description' => 'test description',
//           'email' => $jsonObj->email,
//           'source'  => $token
//       ));  
//       $method = \Stripe\PaymentMethod::create([
//         'type' => 'card',
//         'card' => [
//           'number' => '4000000000003220',
//           'exp_month' =>  $jsonObj->card->exp_month,
//           'exp_year' => $jsonObj->card->exp_year,
          
//         ],
//       ]);
//       $checkout_session = \Stripe\Checkout\Session::create([
//         'line_items' => [ [
//           'price' => 'price_1KyGZ3SJ5Q50OIO5f0aljmTC',
//           'quantity' => 2,
//         ],],
//         'mode' => 'payment',
//         'success_url' =>'http://localhost:4200/cart/id={CKECKOUT_SESSION_ID}',
//         'cancel_url' => 'http://localhost:4200/cart',
//       ]);
//        // details for which payment performed
//     $payDetails = \Stripe\PaymentIntent::create(array(
//       'customer' => $customer->id,
//       'payment_method' => $method->id,
//       // 'confirm'=>true,
//       'amount'   =>'100000',//amount*100
//       'currency' => 'inr',
//       'description' => 'dd',
//       'payment_method_types' => ['card'] 
//       // 'metadata' => array(
//       //     'order_id' => $orderNumber
//       // )
//   ));   
//   $pay = $stripe->paymentIntents->confirm(
//     $payDetails->id
//     // ['payment_method' => 'pm_card_visa']
//   );
  

// // echo json_encode($output); 
//    // get payment details
//    $paymenyResponse = $payDetails->jsonSerialize();
//    // transaction details 
//   //  $amountPaid = $paymenyResponse['amount'];
//   //  $balanceTransaction = $paymenyResponse['balance_transaction'];
//   //  $paidCurrency = $paymenyResponse['currency'];
//   //  $paymentStatus = $paymenyResponse['status'];
//   //  $paymentDate = date("Y-m-d H:i:s");        
  
//   // $session = \Stripe\Checkout\Session::create([
//   //   'payment_method_types' => ['card'],
//   //   'line_items' => [[
//   //     'price_data' => [
//   //       'product' => 'prod_Lest3otvnTRKlI',
//   //       'unit_amount' => 1500,
//   //       'currency' => 'inr',
//   //     ],
//   //     'quantity' => 1,
//   //   ]],
//   //   'mode' => 'payment',
//   //   'success_url' => 'https://example.com/success',
//   //   'cancel_url' => 'https://example.com/cancel',
//   // ]);
//   // if($session){
//   //   echo json_encode("success");
//   // }else{
//   //   echo json_encode("fail");
//   // }
//     // check whether the payment is successful
//     if($paymenyResponse){
//       echo json_encode("success");
//     }else{
//       echo json_encode("fail");
//     }
// }
