<?php
class Product
{
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
  public $max;
  public $min;
  public $Product_Color_ID;
  public $Product_Size;
  public $Quantity;
  public $cat_id;
  public $subcat_id;
  public $Color_ID;
  public $from;
  public $to;


  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get product
  public function read()
  {
    // Create query
    if (isset($this->subcat_id)) {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE Category_ID=? AND SubCategory_ID=?';
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->cat_id);
      $stmt->bindParam(2, $this->subcat_id);

      // Execute query
      $stmt->execute();

      return $stmt;
    } else {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE Category_ID=?';
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->cat_id);
      // $stmt->bindParam(2, $this->subcat_id);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
  }

  // Get  product
  public function read_single()
  {
    // Create query
    $query = 'SELECT * FROM  ' . $this->table . ' WHERE ID=?';

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
  public function get_price()
  {
    // Create query
    $query = 'SELECT max(Product_Price) as MAX,min(Product_Price) as MIN FROM ' . $this->table;

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function get_color()
  {
    // Create query
    $query = 'SELECT * FROM product WHERE Product_Color_ID=? AND Category_ID=?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

     // Bind ID
     $stmt->bindParam(1, $this->Color_ID);
     $stmt->bindParam(2, $this->Category_ID);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function get_size()
  {
    // Create query
    $query = 'SELECT * FROM product WHERE Product_Size=? AND Category_ID=?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

     // Bind ID
     $stmt->bindParam(1, $this->Product_Size);
     $stmt->bindParam(2, $this->Category_ID);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function price_filter()
  {
    // Create query
    $query = 'SELECT * FROM product WHERE Product_Price BETWEEN ? AND ?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

     // Bind ID
     $stmt->bindParam(1, $this->from);
     $stmt->bindParam(2, $this->to);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
  
  
}
