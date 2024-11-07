<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/services.php';

// utilities
$utilities = new Utilities();

// instantiate database and services object
$database = new Database();
$db = $database->getConnection();

// initialize object
$services = new Services($db);

// query services with pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 10; // adjust as needed
$from_record_num = ($records_per_page * $page) - $records_per_page;

$stmt = $services->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // services array
    $services_arr = array();
    $services_arr["records"] = array();
    $services_arr["paging"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $service_item = array(
            "service_no" => $service_no,
            "service_name" => $service_name
        );

        array_push($services_arr["records"], $service_item);
    }

    // include paging
    $total_rows = $services->count();
    $page_url = "{$home_url}services/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $services_arr["paging"] = $paging;

    // set response code - 200 OK
    http_response_code(200);

    // make it JSON format
    echo json_encode($services_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user services do not exist
    echo json_encode(array("message" => "No services found."));
}
?>

