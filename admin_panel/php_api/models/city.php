<?php
  class City {
    // DB Stuff
    private $conn;
    private $table = 'city';

    // Properties
    public $ID;
    public $City;
    public $State_ID;
    public $Country_ID;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get city
    public function read() {
      // Create query
      $query = 'SELECT ID,City,State_ID,Country_ID FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  

}