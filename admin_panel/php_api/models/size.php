<?php
  class Size {
    // DB Stuff
    private $conn;
    private $table = 'product_size';

    // Properties
    public $ID;
    public $Product_Size;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get size
    public function read() {
      // Create query
      $query = 'SELECT ID,Product_Size FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get  size
  public function read_single(){
    // Create query
    $query = 'SELECT * FROM  '. $this->table .' WHERE ID=?';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->ID = $row['ID'];
      $this->Product_Size = $row['Product_Size'];
      
  }

}