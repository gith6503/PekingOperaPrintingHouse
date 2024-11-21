<?php
class Orders {
    // Database connection and table name
    private $conn;
    private $table_name = "orders";

    // Object properties
    public $customer_no;
    public $job_no;
    public $job_status;
    public $estimated_completion;
    public $customer_name;
    public $order_status;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all orders
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY job_no DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single order by job_no
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE job_no = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->job_no);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->job_no = $row['job_no'];
            $this->customer_no = $row['customer_no'];
            $this->job_status = $row['job_status'];
            $this->estimated_completion = $row['estimated_completion'];
            $this->customer_name = $row['customer_name'];
            $this->order_status = $row['order_status'];
        }
    }

    // Create a new order
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET customer_no = :customer_no, job_status = :job_status, 
                      estimated_completion = :estimated_completion, customer_name = :customer_name, 
                      order_status = :order_status";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $this->job_status = htmlspecialchars(strip_tags($this->job_status));
        $this->estimated_completion = htmlspecialchars(strip_tags($this->estimated_completion));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->order_status = htmlspecialchars(strip_tags($this->order_status));

        // Bind values
        $stmt->bindParam(":customer_no", $this->customer_no);
        $stmt->bindParam(":job_status", $this->job_status);
        $stmt->bindParam(":estimated_completion", $this->estimated_completion);
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":order_status", $this->order_status);

        return $stmt->execute();
    }

    // Update an order
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET customer_no = :customer_no, job_status = :job_status, 
                      estimated_completion = :estimated_completion, customer_name = :customer_name, 
                      order_status = :order_status
                  WHERE job_no = :job_no";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->job_no = htmlspecialchars(strip_tags($this->job_no));
        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $this->job_status = htmlspecialchars(strip_tags($this->job_status));
        $this->estimated_completion = htmlspecialchars(strip_tags($this->estimated_completion));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->order_status = htmlspecialchars(strip_tags($this->order_status));

        // Bind values
        $stmt->bindParam(":job_no", $this->job_no);
        $stmt->bindParam(":customer_no", $this->customer_no);
        $stmt->bindParam(":job_status", $this->job_status);
        $stmt->bindParam(":estimated_completion", $this->estimated_completion);
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":order_status", $this->order_status);

        return $stmt->execute();
    }

    // Delete an order
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE job_no = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->job_no = htmlspecialchars(strip_tags($this->job_no));

        // Bind value
        $stmt->bindParam(1, $this->job_no);

        return $stmt->execute();
    }

    // Search for orders
    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . "
                  WHERE customer_name LIKE :keywords 
                     OR job_status LIKE :keywords 
                     OR order_status LIKE :keywords
                  ORDER BY job_no DESC";

        $stmt = $this->conn->prepare($query);

        $keywords = "%" . htmlspecialchars(strip_tags($keywords)) . "%";
        $stmt->bindParam(':keywords', $keywords);

        $stmt->execute();
        return $stmt;
    }

    // Read orders with pagination
    public function readPaging($from_record_num, $records_per_page) {
        $query = "SELECT * FROM " . $this->table_name . "
                  ORDER BY job_no DESC
                  LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    // Count all orders
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
?>
