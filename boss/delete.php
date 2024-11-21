<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/boss.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare orders object
$boss = new Boss($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// set order ID to be deleted
if (!empty($data->boss_no)) {
    $boss->boss_no = $data->boss_no;

    // delete the order
    if ($boss->delete()) {
        // set response code - 200 OK
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Boss was deleted."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to delete boss."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to delete boss. Data is incomplete."));
}
?>
