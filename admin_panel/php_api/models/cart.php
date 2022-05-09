<?php
  class Cart {
    // DB Stuff
    private $conn;
    private $table = 'product_cart';

    // Properties
    public $Cart_ID;
    public $Product_ID;
    public $Color_ID;
    public $Size_ID;
    public $Quantity;
    public $Unit_Price;
    public $User_ID;
    public $Total_Amount;
    public $Product_Name;
    public $Product_Image;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function getcart_items() {
      // Create query
      $query = 'SELECT pclr.Product_Color,psize.Product_Size, pcrt.* FROM '.$this->table.' as pcrt LEFT JOIN product_color as pclr ON pcrt.Color_ID=pclr.ID LEFT JOIN product_size as psize ON pcrt.Size_ID=psize.ID WHERE pcrt.User_ID=?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->User_ID);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function add_item() {
        // Create query
        $query = "INSERT INTO product_cart (Product_ID, User_ID, Product_Name, Color_ID, Size_ID, Product_Image, Unit_Price, Quantity, Total_Amount, Created_At) VALUES (?,?,?,?,?,?,?,?,?,now())";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->Product_ID);
        $stmt->bindParam(2, $this->User_ID);
        $stmt->bindParam(3, $this->Product_Name);
        $stmt->bindParam(4, $this->Color_ID);
        $stmt->bindParam(5, $this->Size_ID);
        $stmt->bindParam(6, $this->Product_Image);
        $stmt->bindParam(7, $this->Unit_Price);
        $stmt->bindParam(8, $this->Quantity);
        $stmt->bindParam(9, $this->Total_Amount);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function update_item() {
        // Create query
   
        $query = "UPDATE product_cart SET Product_ID=:Product_ID,User_ID=:User_ID,Product_Name=:Product_Name,Color_ID=:Color_ID,Size_ID=:Size_ID,Product_Image=:Product_Image,Unit_Price=:Unit_Price,Quantity=:Quantity,Total_Amount=:Total_Amount,Modified_At=now() WHERE ID=:ID";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Product_ID', $this->Product_ID);
        $stmt->bindParam(':User_ID', $this->User_ID);
        $stmt->bindParam(':Product_Name', $this->Product_Name);
        $stmt->bindParam(':Color_ID', $this->Color_ID);
        $stmt->bindParam(':Size_ID', $this->Size_ID);
        $stmt->bindParam(':Product_Image', $this->Product_Image);
        $stmt->bindParam(':Unit_Price', $this->Unit_Price);
        $stmt->bindParam(':Quantity', $this->Quantity);
        $stmt->bindParam(':Total_Amount', $this->Total_Amount);
        $stmt->bindParam(':ID', $this->Cart_ID);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function update_quantity($quantity,$total) {
        // Create query
   
        $query = "UPDATE product_cart SET Product_Name=:Product_Name,Color_ID=:Color_ID,Size_ID=:Size_ID,Product_Image=:Product_Image,Unit_Price=:Unit_Price,Quantity=:Quantity,Total_Amount=:Total_Amount,Modified_At=now() WHERE User_ID=:User_ID AND Product_ID=:Product_ID";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Product_ID', $this->Product_ID);
        $stmt->bindParam(':User_ID', $this->User_ID);
        $stmt->bindParam(':Product_Name', $this->Product_Name);
        $stmt->bindParam(':Color_ID', $this->Color_ID);
        $stmt->bindParam(':Size_ID', $this->Size_ID);
        $stmt->bindParam(':Product_Image', $this->Product_Image);
        $stmt->bindParam(':Unit_Price', $this->Unit_Price);
        $stmt->bindParam(':Quantity', $quantity);
        $stmt->bindParam(':Total_Amount', $total);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function remove_item() {
        // Create query
   
        $query = "DELETE FROM product_cart WHERE ID=?";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->Cart_ID);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function remove_all_item() {
        // Create query
   
        $query = "DELETE FROM product_cart WHERE User_ID=?";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->User_ID);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function check_item() {
        // Create query
   
        $query = "SELECT * FROM product_cart WHERE User_ID=? AND Product_ID=?";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->User_ID);
        $stmt->bindParam(2, $this->Product_ID);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }


   

}