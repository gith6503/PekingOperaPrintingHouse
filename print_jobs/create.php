<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate print_jobs object
include_once '../objects/print_jobs.php';
  
$database = new Database();
$db = $database->getConnection();
  
$printJobs = new PrintJobs($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->job_no) &&
    !empty($data->customer_no) &&
    !empty($data->job_type) &&
    !empty($data->quantity) &&
    !empty($data->job_status) &&
    !empty($data->cost)
){
    // set print_jobs property values
    $printJobs->job_no = $data->job_no;
    $printJobs->customer_no = $data->customer_no;
    $printJobs->job_type = $data->job_type;
    $printJobs->quantity = $data->quantity;
    $printJobs->job_status = $data->job_status;
    $printJobs->cost = $data->cost;
    $printJobs->size = $data->size ?? null;
    $printJobs->shape = $data->shape ?? null;
    $printJobs->sides = $data->sides ?? null;
    $printJobs->paper_size = $data->paper_size ?? null;
    $printJobs->paper_type = $data->paper_type ?? null;
    $printJobs->binding_type = $data->binding_type ?? null;
    $printJobs->print_type = $data->print_type ?? null;
    $printJobs->service_no = $data->service_no ?? null;

    // create the print job
    if ($printJobs->create()) {
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Print job was created."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create print job."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create print job. Data is incomplete."));
}
?>
