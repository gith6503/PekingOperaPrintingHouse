<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and orders object
include_once '../config/database.php';
include_once '../objects/orders.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate orders object
$orders = new Orders($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    !empty($data->job_no) &&
    !empty($data->customer_no) &&
    !empty($data->job_status) &&
    !empty($data->estimated_completion) &&
    !empty($data->customer_name) &&
    !empty($data->order_status)
) {
    // set orders property values
    $orders->job_no = $data->job_no;
    $orders->customer_no = $data->customer_no;
    $orders->job_status = $data->job_status;
    $orders->estimated_completion = $data->estimated_completion;
    $orders->customer_name = $data->customer_name;
    $orders->order_status = $data->order_status;

    // create the order
    if ($orders->create()) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Order was created."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create order."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create order. Data is incomplete."));
}
?>
