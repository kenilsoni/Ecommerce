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
  public $load;
  public $order;
  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function default()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID IN (' . $this->Category_ID . ') AND pdt.Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . '  LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_color()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Product_Color_ID IN (' . $this->Product_Color_ID . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_color_filter()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Product_Color_ID IN (' . $this->Product_Color_ID . ') AND pdt.Subcategory_ID IN (' . $this->Subcategory_ID . ')  AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  public function order_size_filter()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Product_Color_ID IN (' . $this->Product_Color_ID . ') AND pdt.Subcategory_ID IN (' . $this->Subcategory_ID . ') AND pdt.Product_Size IN (' . $this->Product_Size . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_color_cs()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Product_Color_ID IN (' . $this->Product_Color_ID . ') AND pdt.Product_Size IN (' . $this->Product_Size . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_color3()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Subcategory_ID IN (' . $this->Subcategory_ID . ') AND pdt.Product_Size IN (' . $this->Product_Size . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_subcat()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Subcategory_ID IN (' . $this->Subcategory_ID . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function order_size()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=' . $this->Category_ID . ' AND pdt.Product_Size IN (' . $this->Product_Size . ') AND Product_Price BETWEEN ' . $this->from . ' AND ' . $this->to . ' ORDER BY pdt.' . $this->order . ' LIMIT ' . $this->load;
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  // Get product
  public function read()
  {
    // Create query
    if (isset($this->subcat_id)) {
      // echo $this->subcat_id;
      $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID=? AND pdt.Subcategory_ID IN (' . $this->subcat_id . ')  ORDER BY pdt.Created_At DESC LIMIT ' . $this->load;
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->cat_id);
      // Execute query
      $stmt->execute();
      return $stmt;
    } else {
      $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID IN (' . $this->cat_id . ')  ORDER BY pdt.Created_At DESC LIMIT ' . $this->load;
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
  }

  // Get  product
  public function read_single()
  {
    if (isset($this->IsTrending)) {
      // Create query
      $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,psize.ID as size_id,pclr.Product_Color FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID WHERE pdt.IsTrending=1 LIMIT ' . $this->load;
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    } else {
      // Create query
      $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.ID=? LIMIT 1';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->ID);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
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
  public function getall_images()
  {
    // Create query
    $query = 'SELECT Image_Path FROM product_image WHERE Product_ID=?';
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->ID);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function getsingle_image($id)
  {
    // Create query
    $query = 'SELECT Image_Path FROM product_image WHERE Product_ID=' . $id . ' LIMIT 1';
    //Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
  public function all_clr_filter()
  {
    // Create query
    $query = 'SELECT pdt.*,ps.Subcategory_Name,pc.Category_Name,psize.Product_Size,pclr.Product_Color,psize.ID as size_id FROM  product as pdt LEFT JOIN product_category as pc ON pdt.Category_ID=pc.ID LEFT JOIN product_subcategory as ps ON pdt.Subcategory_ID=ps.ID LEFT JOIN product_size as psize ON pdt.Product_Size=psize.ID LEFT JOIN product_color as pclr ON pdt.Product_Color_ID=pclr.ID  WHERE pdt.Category_ID IN (' . $this->Category_ID . ') AND pdt.Product_Color_ID IN (' . $this->Product_Color_ID . ') Product_Price BETWEEN ? AND ? LIMIT ' . $this->load;
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
