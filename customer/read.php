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

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';

// instantiate database and customer object
$database = new Database();
$db = $database->getConnection();

// initialize object
$customer = new customer($db);

// query customer
$stmt = $customer->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0){
  
    // customer array
    $customer_arr = array();
    $customer_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            "customer_no" => $customer_no,
            "customer_name" => $customer_name,
            "customer_email" => $customer_email,
            "address" => $address,
            "status" => $status,
            "gender" => $gender
        );

        array_push($customer_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show customer data in JSON format
    echo json_encode($customer_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no customer found
    echo json_encode(array("message" => "No customer found."));
}
?>
