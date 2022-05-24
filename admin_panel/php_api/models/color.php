<?php
class Color
{
  // DB Stuff
  private $conn;
  private $table = 'product_color';

  // Properties
  public $ID;
  public $Product_Color;
  public $Color_Code;
  public $Product_ID;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get categories
  public function read()
  {
    // Create query
    $query = 'SELECT ID,Product_Color,Color_Code FROM  ' . $this->table . '';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function colorby_product()
  {
    // Create query
    $query = 'SELECT Product_Color_ID FROM  product WHERE ID=?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Product_ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get Single Category
  public function read_single($id)
  {
    // Create query
    $query = 'SELECT ID,Product_Color FROM product_color WHERE ID=' . $id . '';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function total_item($id)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item FROM product WHERE Category_ID=? AND Product_Color_ID=' . $id;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Category_ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function total_item1($id)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item FROM product WHERE Product_Color_ID=' . $id;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
}
