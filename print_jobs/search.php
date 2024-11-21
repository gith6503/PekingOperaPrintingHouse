<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// instantiate database and print_jobs object
$database = new Database();
$db = $database->getConnection();

// initialize object
$printJobs = new PrintJobs($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query print jobs
$stmt = $printJobs->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 records found
if($num > 0){

    // print_jobs array
    $print_jobs_arr = array();
    $print_jobs_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        // Create array for each print job
        $print_job_item = array(
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

        array_push($print_jobs_arr["records"], $print_job_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // output print job data in JSON format
    echo json_encode($print_jobs_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no print jobs found
    echo json_encode(
        array("message" => "No print jobs found.")
    );
}
?>
