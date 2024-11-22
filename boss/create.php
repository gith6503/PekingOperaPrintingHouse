<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and orders object
include_once '../config/database.php';
include_once '../objects/boss.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate boss object
$boss = new Boss($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    !empty($data->boss_no) &&
    !empty($data->boss_name) &&
    !empty($data->boss_email)
) {
    // set boss property values
    $boss->boss_no = $data->boss_no;
    $boss->boss_name = $data->boss_name;
    $boss->boss_email = $data->boss_email;
   

    // create the boss
    if ($boss->create()) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Boss was created."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create boss."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create boss. Data is incomplete."));
}
?>
