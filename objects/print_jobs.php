<?php
class PrintJobs {
    // Database connection and table name
    private $conn;
    private $table_name = "print_jobs";

    // Object properties
    public $job_no;
    public $customer_no;
    public $job_type;
    public $quantity;
    public $job_status;
    public $cost;
    public $size;
    public $shape;
    public $sides;
    public $paper_size;
    public $paper_type;
    public $binding_type;
    public $print_type;
    public $service_no;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all print jobs
    public function read() {
        $query = "SELECT job_no, customer_no, job_type, quantity, job_status, cost, size, shape, sides, paper_size, paper_type, binding_type, print_type, service_no 
                  FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new print job
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET customer_no = :customer_no, job_type = :job_type, quantity = :quantity, job_status = :job_status, 
                      cost = :cost, size = :size, shape = :shape, sides = :sides, paper_size = :paper_size, 
                      paper_type = :paper_type, binding_type = :binding_type, print_type = :print_type, service_no = :service_no";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $this->job_type = htmlspecialchars(strip_tags($this->job_type));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->job_status = htmlspecialchars(strip_tags($this->job_status));
        $this->cost = htmlspecialchars(strip_tags($this->cost));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->shape = htmlspecialchars(strip_tags($this->shape));
        $this->sides = htmlspecialchars(strip_tags($this->sides));
        $this->paper_size = htmlspecialchars(strip_tags($this->paper_size));
        $this->paper_type = htmlspecialchars(strip_tags($this->paper_type));
        $this->binding_type = htmlspecialchars(strip_tags($this->binding_type));
        $this->print_type = htmlspecialchars(strip_tags($this->print_type));
        $this->service_no = htmlspecialchars(strip_tags($this->service_no));

        // Bind values
        $stmt->bindParam(":customer_no", $this->customer_no);
        $stmt->bindParam(":job_type", $this->job_type);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":job_status", $this->job_status);
        $stmt->bindParam(":cost", $this->cost);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":shape", $this->shape);
        $stmt->bindParam(":sides", $this->sides);
        $stmt->bindParam(":paper_size", $this->paper_size);
        $stmt->bindParam(":paper_type", $this->paper_type);
        $stmt->bindParam(":binding_type", $this->binding_type);
        $stmt->bindParam(":print_type", $this->print_type);
        $stmt->bindParam(":service_no", $this->service_no);

        return $stmt->execute();
    }

    // Read a single print job by job_no
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE job_no = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->job_no);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->job_no = $row['job_no'];
            $this->customer_no = $row['customer_no'];
            $this->job_type = $row['job_type'];
            $this->quantity = $row['quantity'];
            $this->job_status = $row['job_status'];
            $this->cost = $row['cost'];
            $this->size = $row['size'];
            $this->shape = $row['shape'];
            $this->sides = $row['sides'];
            $this->paper_size = $row['paper_size'];
            $this->paper_type = $row['paper_type'];
            $this->binding_type = $row['binding_type'];
            $this->print_type = $row['print_type'];
            $this->service_no = $row['service_no'];
        }
    }

    // Update a print job
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET customer_no = :customer_no, job_type = :job_type, quantity = :quantity, job_status = :job_status, 
                      cost = :cost, size = :size, shape = :shape, sides = :sides, paper_size = :paper_size, 
                      paper_type = :paper_type, binding_type = :binding_type, print_type = :print_type, service_no = :service_no
                  WHERE job_no = :job_no";
        $stmt = $this->conn->prepare($query);

        // Sanitize and bind values
        $this->job_no = htmlspecialchars(strip_tags($this->job_no));
        // Use the same sanitization logic as in `create()`

        return $stmt->execute();
    }

    // Delete a print job
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE job_no = ?";
        $stmt = $this->conn->prepare($query);

        $this->job_no = htmlspecialchars(strip_tags($this->job_no));
        $stmt->bindParam(1, $this->job_no);

        return $stmt->execute();
    }

    // Search print jobs
    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . "
                  WHERE customer_no LIKE :keywords 
                     OR job_type LIKE :keywords 
                     OR job_status LIKE :keywords
                  ORDER BY job_no DESC";
        $stmt = $this->conn->prepare($query);

        $keywords = "%" . htmlspecialchars(strip_tags($keywords)) . "%";
        $stmt->bindParam(':keywords', $keywords);

        $stmt->execute();
        return $stmt;
    }
// Read print jobs with pagination
public function readPaging($from_record_num, $records_per_page) {
    $query = "SELECT job_no, customer_no, job_type, quantity, job_status, cost, size, shape, sides, paper_size, paper_type, binding_type, print_type, service_no
              FROM " . $this->table_name . "
              ORDER BY job_no DESC
              LIMIT ?, ?";
    $stmt = $this->conn->prepare($query);

    // Bind pagination variables
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // Execute query
    $stmt->execute();
    return $stmt;
}
    // Count all print jobs
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
?>
