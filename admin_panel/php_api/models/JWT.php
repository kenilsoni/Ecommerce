<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include('../../JWT/vendor/autoload.php');

use Firebase\JWT\JWT;

class JWTtoken
{
    public $secret_key = "skp1506";
    function create_token($token, $secret_key, $algo)
    {
        return JWT::encode($token, $secret_key, $algo);
    }

    function istoken_expire($token)
    {
        $token_payload = $this->decode_token($token);
        $current_time = time();
        $expiry_time = $token_payload->exp;
        if ($current_time >= $expiry_time) {
            return true;
        }
        return false;
    }

    function decode_token($token)
    {
        try {
            return JWT::decode($token, $this->secret_key, array('HS512'));
        } catch (Throwable $e) {
            return false;
        }
    }
}
