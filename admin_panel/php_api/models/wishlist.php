<?php
  class Wishlist {
    // DB Stuff
    private $conn;

    // Properties
    public $user_id;
  


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get data
    public function get_id() {
      // Create query
      $query = 'SELECT * FROM product_wishlist WHERE User_ID=?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->user_id);
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function get_detail($id) {
        // Create query
        $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.ID='.$id.'';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
       
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function remove_item($user_id,$product_id) {
        // Create query
        $query = 'DELETE FROM product_wishlist WHERE User_ID='.$user_id.' AND Product_ID='.$product_id.'';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
       
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function add_wishlist($user_id,$product_id,$priceid) {
        // Create query
        $query = "INSERT INTO product_wishlist (User_ID,Product_ID,Price_ID) VALUES ('$user_id','$product_id','$priceid')";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
       
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
      public function check_wishlist($user_id,$product_id) {
        // Create query
        $query = 'SELECT count(*) as count FROM product_wishlist WHERE User_ID='.$user_id.' AND Product_ID='.$product_id.'';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
       
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }

 
  

  

}