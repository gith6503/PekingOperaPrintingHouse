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
    }

    // Create service method
    public function create() {
        // Query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                  SET service_no=:service_no, service_name=:service_name";
  
        // Prepare query
        $stmt = $this->conn->prepare($query);
  
        // Sanitize
        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $this->service_name = htmlspecialchars(strip_tags($this->service_name));
  
        // Bind values
        $stmt->bindParam(":service_no", $this->service_no);
        $stmt->bindParam(":service_name", $this->service_name);
  
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
  
        return false;
    }

    // Read a single service
    public function readOne() {
        // Query to read single record
        $query = "SELECT service_no, service_name
                  FROM " . $this->table_name . "
                  WHERE service_no = ?
                  LIMIT 0,1";
  
        // Prepare query statement
        $stmt = $this->conn->prepare($query);
  
        // Bind service_no of service to be read
        $stmt->bindParam(1, $this->service_no);
  
        // Execute query
        $stmt->execute();
  
        // Get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a row was retrieved
        if ($row) {
            // Set values to object properties
            $this->service_no = $row['service_no'];
            $this->service_name = $row['service_name'];
        }
    }
    function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                service_name = :service_name
               
            WHERE
                service_no = :service_no";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->service_no=htmlspecialchars(strip_tags($this->service_no));
    $this->service_name=htmlspecialchars(strip_tags($this->service_name));
  
    // bind new values
    $stmt->bindParam(':service_no', $this->service_no);
    $stmt->bindParam(':service_name', $this->service_name);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>

