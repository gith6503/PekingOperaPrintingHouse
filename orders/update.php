<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/orders.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare orders object
$orders = new Orders($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// ensure the required fields are set
if (!empty($data->order_no) && !empty($data->job_no) && !empty($data->order_status)) {

    // set the properties of the order to be updated
    $orders->order_no = $data->order_no;
    $orders->job_no = $data->job_no;
    $orders->order_status = $data->order_status;
    $orders->customer_name = isset($data->customer_name) ? $data->customer_name : null;  // Optional field
    $orders->estimated_completion = isset($data->estimated_completion) ? $data->estimated_completion : null;  // Optional field

    // update the order
    if ($orders->update()) {
        // set response code - 200 OK
        http_response_code(200);
        // tell the user
        echo json_encode(array("message" => "Order was updated."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to update order."));
    }
} else {
    // set response code - 400 Bad Request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to update order. Data is incomplete."));
}
?>
