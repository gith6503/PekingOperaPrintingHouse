<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare services object
$customer = new customer($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// ensure the required fields are set
if (!empty($data->customer_no) && !empty($data->customer_name) && !empty($data->customer_email) && !empty($data->address) && !empty($data->status) && !empty($data->gender)) {

    // set the ID and properties of the service to be updated
    $customer->customer_no = $data->customer_no;
    $customer->customer_name = $data->customer_name;
      $customer->customer_email = $data->customer_email;
    $customer->address = $data->address;
      $customer->status = $data->status;
    $customer->gender = $data->gender;

    // update the service
    if ($customer->update()) {
        // set response code - 200 OK
        http_response_code(200);
        // tell the user
        echo json_encode(array("message" => "Customer was updated."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to update customer."));
    }
} else {
    // set response code - 400 Bad Request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to update customer. Data is incomplete."));
}
?>
