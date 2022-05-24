<?php
class Subcategory
{
  // DB Stuff
  private $conn;
  private $table = 'product_subcategory';

  // Properties
  public $ID;
  public $Subcategory_Name;
  public $Category_ID;
  public $Subcategory_desc;


  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get categories
  public function read()
  {
    // Create query
    $query = 'SELECT ID,Subcategory_Name,Category_ID,Subcategory_desc FROM  ' . $this->table . '';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Category
  public function read_single()
  {
    // Create query
    $query = 'SELECT  ID,Subcategory_Name,Subcategory_desc FROM  ' . $this->table . ' WHERE Category_ID=?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Category_ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  // Get all Category
  public function read_all()
  {
    // Create query
    $query = 'SELECT  ID,Subcategory_Name,Subcategory_desc,Category_ID FROM  ' . $this->table . '';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Category_ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  // get total number of items
  public function total_item($sid, $cid)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item,ct.Category_Name FROM product LEFT JOIN product_category as ct ON product.Category_ID=ct.ID WHERE Category_ID=' . $cid . ' AND Subcategory_ID=' . $sid;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // $stmt->bindParam(2, $this->ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
  // get total number of items
  public function total_item2($id)
  {
    // Create query
    $query = 'SELECT COUNT(*) AS total_item FROM product WHERE Category_ID=? AND Subcategory_ID=' . $id;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->Category_ID);
    // $stmt->bindParam(2, $this->ID);

    // Execute query
    $stmt->execute();
    return $stmt;
  }
}
