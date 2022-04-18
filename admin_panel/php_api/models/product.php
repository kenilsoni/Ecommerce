<?php
  class Product {
    // DB Stuff
    private $conn;
    private $table = 'product';

    // Properties
    public $ID;
    public $Product_Name;
    public $Product_Description;
    public $Product_Price;
    public $Product_Quantity;
    public $IsTrending;
    public $Subcategory_ID;
    public $Category_ID;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get product
    public function read() {
      // Create query
      $query = 'SELECT * FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get  product
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
      $this->Product_Name = $row['Product_Name'];
      $this->Product_Description = $row['Product_Description'];
      $this->Product_Price = $row['Product_Price'];
      $this->Product_Quantity = $row['Product_Quantity'];
      $this->IsTrending = $row['IsTrending'];
      $this->Subcategory_ID = $row['Subcategory_ID'];
      $this->Category_ID = $row['Category_ID'];
  }

}