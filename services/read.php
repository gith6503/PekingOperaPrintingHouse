/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  opera
 * Created: 17 Oct 2024
 */

<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/services.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$services = new Services($db);

// query products
$stmt = $services->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0){
  
    // services array
    $services_arr = array();
    $services_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            "service_no" => $service_no,
            "service_name" => $service_name
        );

        array_push($services_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in JSON format
    echo json_encode($services_arr);
}
else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(array("message" => "No services found."));
}
?>
