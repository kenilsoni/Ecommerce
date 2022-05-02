
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers:* ");
require_once("../../models/JWT.php");
$jwt = new JWTtoken();

$getdata = file_get_contents("php://input");

if (isset($getdata)) {
    $request = json_decode($getdata);
    if ($request->refreshToken) {
        if ($jwt->istoken_expire($request->refreshToken)) {
            http_response_code(403);
        } else {
            $secret_key = "skp1506";
            $issuer_claim = "localhost";
            $audience_claim = "user_auth";
            $issuedat_claim = time(); // time issued 
            $notbefore_claim = $issuedat_claim + 10;
            $expire_claim = $issuedat_claim + 20;

            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
            );
            $newtoken = $jwt->create_token($token, $secret_key, 'HS512');
            echo json_encode(["result" => $newtoken, "expiry" => $expire_claim]);
        }
    }
}


?>