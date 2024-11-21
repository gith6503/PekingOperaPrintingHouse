<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include necessary files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/orders.php';

// initialize utilities and database
$utilities = new Utilities();
$database = new Database();
$db = $database->getConnection();

// initialize orders object
$orders = new Orders($db);

// get pagination details from URL parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 10;
$from_record_num = ($records_per_page * $page) - $records_per_page;

// query orders with pagination
$stmt = $orders->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 records found
if ($num > 0) {

    // orders array
    $orders_arr = array();
    $orders_arr["records"] = array();
    $orders_arr["paging"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            "customer_no" => $customer_no,
            "job_no" => $job_no,
            "customer_name" => $customer_name,
            "job_status" => $job_status,
            "order_status" => $order_status,
            "estimated_completion" => $estimated_completion
        );

        array_push($orders_arr["records"], $item);
    }

    // include paging details
    $total_rows = $orders->count() ?? 0;
    $page_url = "{$home_url}orders/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $orders_arr["paging"] = $paging;

    // set response code - 200 OK
    http_response_code(200);

    // output JSON response
    echo json_encode($orders_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // output message if no orders found
    echo json_encode(array("message" => "No orders found."));
}
?>
