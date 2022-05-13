<?php
  class Slider {
    // DB Stuff
    private $conn;
    private $table = 'slider';

  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get size
    public function read() {
      // Create query
      $query = 'SELECT Image_Path FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

 
}