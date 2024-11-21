<?php
class Customer {
    // Database connection and table name
    private $conn;
    private $table_name = "customer";

    // Object properties
    public $customer_no;
    public $customer_name;
     public $customer_email;
    public $address;
     public $status;
    public $gender;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all customer
    public function read() {
        $query = "SELECT customer_no, customer_name, customer_email, address, status, gender FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new customer
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET customer_no = :customer_no, customer_name = :customer_name, customer_email = :customer_email, address = :address, status = :status, gender = :gender";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->address = htmlspecialchars(strip_tags($this->address));
         $this->status = htmlspecialchars(strip_tags($this->status));
        $this->gender = htmlspecialchars(strip_tags($this->gender));

        // Bind values
        $stmt->bindParam(":customer_no", $this->customer_no);
        $stmt->bindParam(":customer_name", $this->customer_name);
          $stmt->bindParam(":customer_email", $this->customer_email);
        $stmt->bindParam(":address", $this->address);
          $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":gender", $this->gender);

        return $stmt->execute();
    }

    // Read a single service by customer_no
    public function readOne() {
        $query = "SELECT customer_no, customer_name, customer_email, address, status, gender
                  FROM " . $this->table_name . "
                  WHERE customer_no = ?
                  LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->customer_no);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->customer_no = $row['customer_no'];
            $this->customer_name = $row['customer_name'];
             $this->customer_email = $row['customer_email'];
            $this->address = $row['address'];
            $this->status = $row['status'];
            $this->gender = $row['gender'];
        }
    }

    // Update a customer
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET customer_name = :customer_name,
                   customer_email = :customer_email,
                  address = :address,
                  status = :status,
                  gender = :gender
                  WHERE customer_no = :customer_no";
        $stmt = $this->conn->prepare($query);

        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
          $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->gender = htmlspecialchars(strip_tags($this->gender));

        $stmt->bindParam(':customer_no', $this->customer_no);
        $stmt->bindParam(':customer_name', $this->customer_name);
         $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':address', $this->address);
         $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':gender', $this->gender);

        return $stmt->execute();
    }

    // Delete a customer
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE customer_no = ?";
        $stmt = $this->conn->prepare($query);

        $this->customer_no = htmlspecialchars(strip_tags($this->customer_no));
        $stmt->bindParam(1, $this->customer_no);

        return $stmt->execute();
    }

    // Search customer by name or number
 public function search($keywords) {
    $query = "SELECT customer_no, customer_name, customer_email, address, status, gender
              FROM " . $this->table_name . "
              WHERE customer_name LIKE :keywords 
                 OR customer_no LIKE :keywords 
                 OR customer_email LIKE :keywords 
                 OR address LIKE :keywords 
                 OR status LIKE :keywords 
                 OR gender LIKE :keywords
              ORDER BY customer_no DESC";
    
    $stmt = $this->conn->prepare($query);

    // Sanitize input and prepare the search keyword
    $keywords = "%" . htmlspecialchars(strip_tags($keywords)) . "%";

    // Bind parameters
    $stmt->bindParam(':keywords', $keywords);

    // Execute the query
    $stmt->execute();
    
    return $stmt;
}


    // Read customer with pagination
    public function readPaging($from_record_num, $records_per_page) {
        $query = "SELECT customer_no, customer_name, customer_email, address, status, gender
                  FROM " . $this->table_name . "
                  ORDER BY customer_no DESC
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


