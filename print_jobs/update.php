<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare print_jobs object
$printJobs = new PrintJobs($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// ensure the required fields are set
if (!empty($data->job_no) && !empty($data->job_name) && !empty($data->status)) {

    // set the ID and properties of the print job to be updated
    $printJobs->job_no = $data->job_no;
    $printJobs->job_name = $data->job_name;
    $printJobs->status = $data->status;
    $printJobs->customer_no = isset($data->customer_no) ? $data->customer_no : null;  // Optional field
  

    // update the print job
    if ($printJobs->update()) {
        // set response code - 200 OK
        http_response_code(200);
        // tell the user
        echo json_encode(array("message" => "Print job was updated."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to update print job."));
    }
} else {
    // set response code - 400 Bad Request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to update print job. Data is incomplete."));
}
?>
