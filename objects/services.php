<?php
class Services {
    // Database connection and table name
    private $conn;
    private $table_name = "services";

    // Object properties
    public $service_no;
    public $service_name;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read services method
    public function read() {
        // Select all query
        $query = "SELECT service_no, service_name FROM " . $this->table_name;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    } // <- make sure this bracket is here to close the function
} // <- make sure this bracket is here to close the class
?>
