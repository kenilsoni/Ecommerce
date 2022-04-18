<?php
  class State {
    // DB Stuff
    private $conn;
    private $table = 'state';

    // Properties
    public $ID;
    public $State;
    public $Country_ID;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get state
    public function read() {
      // Create query
      $query = 'SELECT ID,State,Country_ID FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  

}