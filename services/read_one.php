<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/services.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare services object
$services = new Services($db);

// set ID property of record to read
$services->service_no = isset($_GET['service_no']) ? $_GET['service_no'] : die();

// read the details of service to be read
$services->readOne();

// check if service_name exists
if ($services->service_name != null) {
    // create array
    $services_arr = array(
        "service_no" => $services->service_no,
        "service_name" => $services->service_name // Corrected here
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it JSON format
    echo json_encode($services_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user service does not exist
    echo json_encode(array("message" => "Service does not exist."));
}
?>
