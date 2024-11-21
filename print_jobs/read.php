<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// instantiate database and print_jobs object
$database = new Database();
$db = $database->getConnection();

// initialize object
$printJobs = new PrintJobs($db);

// query print jobs
$stmt = $printJobs->read();
$num = $stmt->rowCount();

// check if more than 0 records found
if($num > 0){
  
    // print jobs array
    $print_jobs_arr = array();
    $print_jobs_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $print_job_item = array(
            "job_no" => $job_no,
            "job_name" => $job_name,
            "status" => $status,
            "customer_no" => $customer_no
            
        );

        array_push($print_jobs_arr["records"], $print_job_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show print jobs data in JSON format
    echo json_encode($print_jobs_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no print jobs found
    echo json_encode(array("message" => "No print jobs found."));
}
?>
