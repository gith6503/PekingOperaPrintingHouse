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
        $query = "SELECT service_no, service_name FROM " . $this->pekingoperaprintinghouse_db;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    } // <- make sure this bracket is here to close the function
    // create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->pekingoperaprintinghouse_db . "
            SET
                service_no=:service_no, service_name=:service_name";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->service_no=htmlspecialchars(strip_tags($this->service_no));
    $this->service_name=htmlspecialchars(strip_tags($this->service_name));
  
    // bind values
    $stmt->bindParam(":service_no", $this->service_no);
    $stmt->bindParam(":service_name", $this->service_name);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}
} // <- make sure this bracket is here to close the class
?>
