<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
require_once("../../models/JWT.php");
$jwt = new JWTtoken();

if(isset(apache_request_headers()["access_token"])){
    try{
        $access_token = apache_request_headers()["access_token"];
        if($access_token!=''){
            if($jwt->istoken_expire($access_token)){
                http_response_code(401);
            }
        }
    }catch(Throwable $e){
        http_response_code(404);
    }
}
