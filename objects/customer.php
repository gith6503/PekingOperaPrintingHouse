<?php
class customer{
  
    // database connection and table name
    private $conn;
    private $table_name = "customer";
  
    // object properties
    public $customer_no;
    public $customer_name;
    public $customer_email;
    public $phone;
    public $address;
    public $status;
    public $gender;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
   