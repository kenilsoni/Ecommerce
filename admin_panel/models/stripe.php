<?php
class Stripe
{

    public function stripe_key()
    {
        require './php_api/api/checkout/stripe-php-master/init.php';
        return new \Stripe\StripeClient(
            'sk_test_51KxNo9SJ5Q50OIO5VnFcjevn1wRbzTfYFTuxvZ05BIf1jMdKOQVNiMtQKzE21DsCZqQkSDYu8UQXo4K8cMIOub1j00ehZHuEn'
        );
    }
}
