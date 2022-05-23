<?php
  class Order {
    // DB Stuff
    private $conn;
    private $table = 'order_details';


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get country
    public function read($id,$order) {
      // Create query
      $query = "SELECT * FROM   $this->table  WHERE User_ID=?  ORDER BY Created_At DESC LIMIT $order";

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $id);
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function get_details_pdt($id)
    {
        $sql = "SELECT pdt.Product_Name,pdt.Product_Price,pimg.Image_Path FROM product as pdt LEFT JOIN product_image as pimg ON pdt.ID=pimg.Product_ID WHERE pdt.ID=? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function get_clr($id)
    {
        $sql = "SELECT Product_Color FROM product_color WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }

    public function get_size($id)
    {
        $sql = "SELECT Product_Size FROM product_size WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function get_orderid($orderid)
    {
        $sql = "SELECT * FROM order_details WHERE Order_ID=$orderid ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function check_st($orderid,$status,$data)
    {
        $sql = "SELECT * FROM order_details WHERE Order_ID=$orderid AND Status IN ($status) AND $data";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function check_stn($id,$name)
    {
        $sql = "SELECT pdt.Product_Name,pdt.Product_Price,pimg.Image_Path FROM product as pdt LEFT JOIN product_image as pimg ON pdt.ID=pimg.Product_ID WHERE pdt.ID=? AND pdt.Product_Name LIKE '%$name%' LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function check_s($orderid,$status)
    {
        $sql = "SELECT * FROM order_details WHERE Order_ID=$orderid AND Status IN ($status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function check_t($orderid,$data)
    {
        $sql = "SELECT * FROM order_details WHERE Order_ID=$orderid AND $data";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }

  

}