<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare customer object
$customer = new customer($db);

// set ID property of record to read
$customer->customer_no = isset($_GET['customer_no']) ? $_GET['customer_no'] : die();

// read the details of customer to be read
$customer->readOne();

// check if customer_name exists
if ($customer->customer_name != null) {
    // create array
    $customer_arr = array(
        "customer_no" => $customer->customer_no,
        "customer_name" => $customer->customer_name, // Corrected here
             "customer_email" => $customer->service_email,
        "address" => $customer->address, // Corrected here
             "status" => $customer->status, // Corrected here
             "status" => $customer->gender
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it JSON format
    echo json_encode($customer_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user customer does not exist
    echo json_encode(array("message" => "Customer does not exist."));
}
?>
