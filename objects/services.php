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

    // Read all services
    public function read() {
        $query = "SELECT service_no, service_name FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new service
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET service_no = :service_no, service_name = :service_name";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $this->service_name = htmlspecialchars(strip_tags($this->service_name));

        // Bind values
        $stmt->bindParam(":service_no", $this->service_no);
        $stmt->bindParam(":service_name", $this->service_name);

        return $stmt->execute();
    }

    // Read a single service by service_no
    public function readOne() {
        $query = "SELECT service_no, service_name
                  FROM " . $this->table_name . "
                  WHERE service_no = ?
                  LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->service_no);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->service_no = $row['service_no'];
            $this->service_name = $row['service_name'];
        }
    }

    // Update a service
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET service_name = :service_name
                  WHERE service_no = :service_no";
        $stmt = $this->conn->prepare($query);

        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $this->service_name = htmlspecialchars(strip_tags($this->service_name));

        $stmt->bindParam(':service_no', $this->service_no);
        $stmt->bindParam(':service_name', $this->service_name);

        return $stmt->execute();
    }

    // Delete a service
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE service_no = ?";
        $stmt = $this->conn->prepare($query);

        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $stmt->bindParam(1, $this->service_no);

        return $stmt->execute();
    }

    // Search services by name or number
    public function search($keywords) {
        $query = "SELECT service_no, service_name
                  FROM " . $this->table_name . " 
                  WHERE service_name LIKE ? OR service_no LIKE ? 
                  ORDER BY service_no DESC";
        $stmt = $this->conn->prepare($query);

        $keywords = "%" . htmlspecialchars(strip_tags($keywords)) . "%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();
        return $stmt;
    }

    // Read services with pagination
    public function readPaging($from_record_num, $records_per_page) {
        $query = "SELECT service_no, service_name
                  FROM " . $this->table_name . "
                  ORDER BY service_no DESC
                  LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);

        // Bind pagination variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }
   public function count() {
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
  
    // Prepare and execute the query
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the count
    return $row['total_rows'];
}

}
?>


