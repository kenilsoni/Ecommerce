<?php
  class Subcategory {
    // DB Stuff
    private $conn;
    private $table = 'product_subcategory';

    // Properties
    public $ID;
    public $Subcategory_Name;
    public $Category_ID;
    public $Subcategory_desc;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT ID,Subcategory_Name,Category_ID,Subcategory_desc FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT  ID,Subcategory_Name,Category_ID,Subcategory_desc FROM  ' . $this->table . ' WHERE ID=?';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->ID = $row['ID'];
      $this->Subcategory_Name = $row['Subcategory_Name'];
      $this->Category_ID = $row['Category_ID'];
      $this->Subcategory_desc = $row['Subcategory_desc'];

  }

}