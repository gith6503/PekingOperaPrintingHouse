<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare print_jobs object
$printJobs = new PrintJobs($db);

// set ID property of record to read
$printJobs->job_no = isset($_GET['job_no']) ? $_GET['job_no'] : die();

// read the details of print job to be read
$printJobs->readOne();

// check if job_name exists
if ($printJobs->job_name != null) {
    // create array
    $print_jobs_arr = array(
         "customer_no"=> $customer_no,
            "job_no" => $job_no,
            "job_type" => $job_type,
            "quantity"=> $quantity,
            "job_status" => $job_status,
            "cost" => $cost,
            "size" => $size,
            "shape" => $shape,
            "sides"=> $sides,
            "paper_size" => $paper_size,
            "paper_type" => $paper_type,
               "binding_type"=> $binding_type,
            "print_type" => $print_type,
            "service_no" => $service_no
            

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it JSON format
    echo json_encode($print_jobs_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user print job does not exist
    echo json_encode(array("message" => "Print job does not exist."));
}
?>
