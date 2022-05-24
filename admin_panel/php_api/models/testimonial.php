<?php
class Testimonial
{
  // DB Stuff
  private $conn;
  private $table = 'testimonial';



  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get size
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
