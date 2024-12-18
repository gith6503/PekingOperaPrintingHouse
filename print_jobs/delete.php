<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare print_jobs object
$printJobs = new PrintJobs($db);

// get print job id
$data = json_decode(file_get_contents("php://input"));

// set print job id to be deleted
$printJobs->job_no = $data->job_no;

// delete the print job
if($printJobs->delete()) {

    // set response code - 200 OK
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Print job was deleted."));
}

// if unable to delete the print job
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete print job."));
}
?>
