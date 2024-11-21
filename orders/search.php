<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include necessary files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/orders.php';

// instantiate database and orders object
$database = new Database();
$db = $database->getConnection();

// initialize object
$orders = new Orders($db);

// get search keyword
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query orders
$stmt = $orders->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 records found
if($num > 0) {

    // orders array
    $orders_arr = array();
    $orders_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Create array for each order
        $order_item = array(
            "customer_no" => $customer_no,
            "job_no" => $job_no,
            "customer_name" => $customer_name,
            "job_status" => $job_status,
            "order_status" => $order_status,
            "estimated_completion" => $estimated_completion
        );

        array_push($orders_arr["records"], $order_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // output orders data in JSON format
    echo json_encode($orders_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no orders found
    echo json_encode(array("message" => "No orders found."));
}
?>
