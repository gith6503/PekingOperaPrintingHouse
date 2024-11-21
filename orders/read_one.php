<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/orders.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare orders object
$orders = new Orders($db);

// set ID property of record to read
$orders->job_no = isset($_GET['job_no']) ? $_GET['job_no'] : die();

// read the details of the order to be read
$orders->readOne();

// check if `job_no` exists
if ($orders->job_no != null) {
    // create array
    $order_arr = array(
        "job_no" => $orders->job_no,
        "customer_no" => $orders->customer_no,
        "customer_name" => $orders->customer_name,
        "job_status" => $orders->job_status,
        "order_status" => $orders->order_status,
        "estimated_completion" => $orders->estimated_completion
    );

    // set response code - 200 OK
    http_response_code(200);

    // output the order in JSON format
    echo json_encode($order_arr);
} else {
    // set response code - 404 Not Found
    http_response_code(404);

    // tell the user the order does not exist
    echo json_encode(array("message" => "Order does not exist."));
}
?>
