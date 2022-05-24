<?php
class Coupan
{
  // DB Stuff
  private $conn;
  private $table = 'product_coupan';

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get country
  public function read()
  {
    // Create query
    $query = 'SELECT * FROM  ' . $this->table . '';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
}
