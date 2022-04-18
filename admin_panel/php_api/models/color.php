<?php
  class Color {
    // DB Stuff
    private $conn;
    private $table = 'product_color';

    // Properties
    public $ID;
    public $Product_Color;
    public $Color_Code;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT ID,Product_Color,Color_Code FROM  ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT ID,Product_Color,Color_Code FROM  ' . $this->table . ' WHERE ID=?';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->ID = $row['ID'];
      $this->Product_Color = $row['Product_Color'];
      $this->Color_Code = $row['Color_Code'];
  }

}