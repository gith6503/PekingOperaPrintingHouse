<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/services.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare services object
$services = new Services($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// ensure the required fields are set
if (!empty($data->service_no) && !empty($data->service_name)) {

    // set the ID and properties of the service to be updated
    $services->service_no = $data->service_no;
    $services->service_name = $data->service_name;

    // update the service
    if ($services->update()) {
        // set response code - 200 OK
        http_response_code(200);
        // tell the user
        echo json_encode(array("message" => "Service was updated."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to update service."));
    }
} else {
    // set response code - 400 Bad Request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to update service. Data is incomplete."));
}
?>
