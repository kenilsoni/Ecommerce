<?php
  class Country {
    // DB Stuff
    private $conn;
    private $table = 'country';

    // Properties
    public $ID;
    public $Country;
    
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get country
    public function read() {
      // Create query
      $query = 'SELECT ID,Country FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  

}