<?php
class Size
{
  // DB Stuff
  private $conn;
  private $table = 'product_size';

  // Properties
  public $ID;
  public $Product_Size;
  public $Category_ID;
  public $Product_ID;


  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get size
  public function read()
  {
    // Create query
    $query = 'SELECT ID,Product_Size FROM  ' . $this->table . '';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get  size
  public function read_single($id)
  {
    // Create query
    $query = 'SELECT ID,Product_Size FROM product_size WHERE ID=' . $id . '';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function sizeby_product()
  {
    // Create query
    $query = 'SELECT Product_Size FROM  product WHERE ID=?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Product_ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function total_item($id)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item FROM product WHERE Category_ID=? AND Product_Size =' . $id;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Category_ID);
    // $stmt->bindParam(2, $this->ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function total_item1($id)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item FROM product WHERE Product_Size =' . $id;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
}
