<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/boss.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare boss object
$boss = new Boss($db);

// set ID property of record to read
$boss->boss_no = isset($_GET['boss_no']) ? $_GET['boss_no'] : die();

// read the details of the boss to be read
$boss->readOne();

// check if `boss_no` exists
if ($boss->boss_no != null) {
    // create array
    $boss_arr = array(
        "boss_no" => $orders->job_no,
     
        "boss_name" => $orders->customer_name,
       
        "boss_email" => $orders->boss_email
    );

    // set response code - 200 OK
    http_response_code(200);

    // output the order in JSON format
    echo json_encode($boss_arr);
} else {
    // set response code - 404 Not Found
    http_response_code(404);

    // tell the user the boss does not exist
    echo json_encode(array("message" => "Boss does not exist."));
}
?>
