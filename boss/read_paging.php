<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include necessary files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/boss.php';

// initialize utilities and database
$utilities = new Utilities();
$database = new Database();
$db = $database->getConnection();

// initialize orders object
$boss = new Boss($db);

// get pagination details from URL parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 10;
$from_record_num = ($records_per_page * $page) - $records_per_page;

// query orders with pagination
$stmt = $boss->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 records found
if ($num > 0) {

    // orders array
    $boss_arr = array();
    $boss_arr["records"] = array();
    $boss_arr["paging"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            "boss_no" => $boss_no,
          
            "boss_name" => $boss_name,
         
            "boss_email" => $boss_email
        );

        array_push($boss_arr["records"], $item);
    }

    // include paging details
    $total_rows = $boss->count() ?? 0;
    $page_url = "{$home_url}boss/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $boss_arr["paging"] = $paging;

    // set response code - 200 OK
    http_response_code(200);

    // output JSON response
    echo json_encode($boss_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // output message if no orders found
    echo json_encode(array("message" => "No boss found."));
}
?>
