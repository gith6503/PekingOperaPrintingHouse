<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/boss.php';

// instantiate database and boss object
$database = new Database();
$db = $database->getConnection();

// initialize object
$boss = new Boss($db);

// query boss records
$stmt = $boss->read();
$num = $stmt->rowCount();

// check if more than 0 records found
if ($num > 0) {

    // boss array
    $boss_arr = array();
    $boss_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $boss_item = array(
            "job_no" => $boss_no,      // Assuming 'boss_no' is a field in the database
            "order_status" => $boss_name,  // Assuming 'boss_name' is a field in the database
            "estimated_completion" => $boss_email  // Assuming 'boss_email' is a field in the database
        );

        array_push($boss_arr["records"], $boss_item);  // Push the correct variable into the array
    }

    // set response code - 200 OK
    http_response_code(200);

    // output boss data in JSON format
    echo json_encode($boss_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no boss records found
    echo json_encode(array("message" => "No boss found."));
}
?>
