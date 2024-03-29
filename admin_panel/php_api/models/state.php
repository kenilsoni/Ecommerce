<?php
class State
{
  // DB Stuff
  private $conn;
  private $table = 'state';

  // Properties
  public $ID;
  public $State;
  public $Country_ID;


  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get state
  public function read($ID)
  {
    // Create query
    $query = 'SELECT ID,State,Country_ID FROM  ' . $this->table . ' WHERE Country_ID=' . $ID . '';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
}
