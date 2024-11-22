<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/orders.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare orders object
$orders = new Orders($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// set order ID to be deleted
if (!empty($data->job_no)) {
    $orders->job_no = $data->job_no;

    // delete the order
    if ($orders->delete()) {
        // set response code - 200 OK
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Order was deleted."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to delete order."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to delete order. Data is incomplete."));
}
?>