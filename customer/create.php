/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  opera
 * Created: 17 Oct 2024
 */
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/customer.php';
  
$database = new Database();
$db = $database->getConnection();
  
$customer = new customer($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->customer_no) &&
    !empty($data->customer_name)&&
    !empty($data->customer_email)&&
    !empty($data->address)&&
    !empty($data->status)&&
    !empty($data->gender)
){
  
    // set product property values
    $customer->customer_no = $data->customer_no;
    $customer->service_name = $data->customer_name;
     $customer->customer_email = $data->customer_email;
    $customer->address = $data->status;
    $customer->gender = $data->gender;
  
  
    // create the product
    if($customer->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "customer was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create customer."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create customer. Data is incomplete."));
}
?>
