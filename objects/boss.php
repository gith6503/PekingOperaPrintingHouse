<?php
class Boss {
    // Database connection and table name
    private $conn;
    private $table_name = "boss";

    // Object properties
    public $boss_no;
    public $boss_name;
       public $boss_email;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all services
    public function read() {
        $query = "SELECT boss_no, boss_name, boss_email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new service
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET boss_no = :boss_no, boss_name = :boss_name, boss_email = :boss_email";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->boss_no = htmlspecialchars(strip_tags($this->boss_no));
        $this->boss_name = htmlspecialchars(strip_tags($this->boss_name));
        $this->boss_email = htmlspecialchars(strip_tags($this->boss_email));

        // Bind values
        $stmt->bindParam(":boss_no", $this->boss_no);
        $stmt->bindParam(":boss_name", $this->boss_name);
        $stmt->bindParam(":boss_email", $this->boss_email);

        return $stmt->execute();
    }

    // Read a single service by service_no
    public function readOne() {
        $query = "SELECT boss_no, boss_name, boss_email
                  FROM " . $this->table_name . "
                  WHERE boss_no = ?
                  LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->boss_no);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->boss_no = $row['boss_no'];
            $this->boss_name = $row['boss_name'];
                $this->boss_email = $row['boss_email'];
        }
    }

    // Update a service
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET boss_name = :boss_name
                      boss_email = :boss_email
                  WHERE boss_no = :boss_no";
        $stmt = $this->conn->prepare($query);

        $this->boss_no = htmlspecialchars(strip_tags($this->boss_no));
        $this->boss_name = htmlspecialchars(strip_tags($this->boss_name));

        $stmt->bindParam(':boss_no', $this->boss_no);
        $stmt->bindParam(':boss_name', $this->boss_name);

        return $stmt->execute();
    }

    // Delete a service
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE boss_no = ?";
        $stmt = $this->conn->prepare($query);

        $this->boss_no = htmlspecialchars(strip_tags($this->boss_no));
        $stmt->bindParam(1, $this->boss_no);

        return $stmt->execute();
    }

    public function search($keywords) {
    // Prepare the SQL query with the search condition
    $query = "SELECT boss_no, boss_name, boss_email
              FROM " . $this->table_name . " 
              WHERE boss_name LIKE :keywords 
                 OR boss_no LIKE :keywords 
                 OR boss_email LIKE :keywords
              ORDER BY boss_no DESC";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Sanitize the keywords to prevent SQL injection
    $keywords = "%" . htmlspecialchars(strip_tags($keywords)) . "%";

    // Bind the parameters
    $stmt->bindParam(":keywords", $keywords);

    // Execute the statement
    $stmt->execute();

    // Return the statement (can be used in the controller to fetch results)
    return $stmt;
}


    // Read services with pagination
    public function readPaging($from_record_num, $records_per_page) {
        $query = "SELECT boss_no, boss_name, boss_email
                  FROM " . $this->table_name . "
                  ORDER BY boss_no DESC
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



