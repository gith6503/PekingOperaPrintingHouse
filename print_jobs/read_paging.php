<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/print_jobs.php';

// initialize utilities and database
$utilities = new Utilities();
$database = new Database();
$db = $database->getConnection();

// initialize print_jobs object
$printJobs = new PrintJobs($db);

// get pagination details from URL parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 10;
$from_record_num = ($records_per_page * $page) - $records_per_page;

// query print jobs with pagination
$stmt = $printJobs->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 records found
if ($num > 0) {

    // print_jobs array
    $print_jobs_arr = array();
    $print_jobs_arr["records"] = array();
    $print_jobs_arr["paging"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
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

        array_push($print_jobs_arr["records"], $item);
    }

    // include paging details
    $total_rows = $printJobs->count() ?? 0;
    $page_url = "{$home_url}print_jobs/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $print_jobs_arr["paging"] = $paging;

    // set response code - 200 OK
    http_response_code(200);

    // output JSON response
    echo json_encode($print_jobs_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // output message if no print jobs found
    echo json_encode(array("message" => "No print jobs found."));
}
?>
