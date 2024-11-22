<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/customer.php';

// initialize utilities and database
$utilities = new Utilities();
$database = new Database();
$db = $database->getConnection();

// initialize customer object
$customer = new customer($db);

// get pagination details from URL parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 10;
$from_record_num = ($records_per_page * $page) - $records_per_page;

// query customer with pagination
$stmt = $customer->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // customer array
    $customer_arr = array();
    $customer_arr["records"] = array();
    $customer_arr["paging"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            "customer_no" => $customer_no,
            "customer_name" => $customer_name,
            "customer_email" => $customer_email,
            "address" => $address,
             "status" => $status,
            "gender" => $gender
        );

        array_push($customer_arr["records"], $item);
    }

    // include paging details
    $total_rows = $customer->count() ?? 0;
    $page_url = "{$home_url}customer/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $customer_arr["paging"] = $paging;

    // set response code - 200 OK
    http_response_code(200);

    // output JSON response
    echo json_encode($customer_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // output message if no customer found
    echo json_encode(array("message" => "No customer found."));
}
?>
