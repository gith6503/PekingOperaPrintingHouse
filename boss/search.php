<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include necessary files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/boss.php';

// instantiate database and orders object
$database = new Database();
$db = $database->getConnection();

// initialize object
$boss = new Boss($db);

// get search keyword
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query orders
$stmt = $boss->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 records found
if($num > 0) {

    // orders array
    $boss_arr = array();
    $boss_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Create array for each order
        $boss_item = array(
            "boss_no" => $boss_no,
   
            "boss_name" => $boss_name,
           
            "boss_email" => $boss_email
        );

        array_push($boss_arr["records"], $boss_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // output orders data in JSON format
    echo json_encode($boss_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no orders found
    echo json_encode(array("message" => "No boss found."));
}
?>
