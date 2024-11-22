<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/boss.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare boss object
$boss = new Boss($db);

// get the posted data
$data = json_decode(file_get_contents("php://input"));

// ensure the required fields are set
if (!empty($data->boss_no) && !empty($data->boss_name) && !empty($data->boss_email)) {

    // set the properties of the boss to be updated

    $boss->boss_no = $data->boss_no;
  
    $boss->boss_name = isset($data->boss_name) ? $data->boss_name : null;  // Optional field
    $boss->boss_email = isset($data->boss_email) ? $data->boss_email : null;  // Optional field

    // update the boss
    if ($boss->update()) {
        // set response code - 200 OK
        http_response_code(200);
        // tell the user
        echo json_encode(array("message" => "Boss was updated."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to update boss."));
    }
} else {
    // set response code - 400 Bad Request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to update boss. Data is incomplete."));
}
?>
