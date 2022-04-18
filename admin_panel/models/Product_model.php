<?php
class ProductModel
{
    function __construct()
    {

        try {
            /* Properties */
            $dsn = 'mysql:dbname=ecommerce;host=localhost';
            $user = 'root';
            $password = '';
            $this->conn = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
    }
    // color start
    public function color_data()
    {
        $sql = "SELECT * FROM product_color";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function colordata_id($id)
    {
        $sql = "SELECT * FROM product_color WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_colordb($color, $code)
    {
        $sql = "INSERT INTO product_color (Product_Color,Color_Code) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$color, $code]);
        return $success;
    }
    public function update_color($color, $id, $code)
    {
        $sql = "UPDATE product_color SET Product_Color=?,Color_Code=?,Modified_At=NOW() WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$color, $code, $id]);
        return $success;
    }
    public function delete_color($id)
    {
        $sql = "DELETE FROM product_color WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    // size start
    public function size_data()
    {
        $sql = "SELECT * FROM product_size";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_sizedb($size)
    {
        $sql = "INSERT INTO product_size (Product_Size) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$size]);
        return $success;
    }
    public function update_size($size, $id)
    {
        $sql = "UPDATE product_size SET Product_Size=?,Modified_At=NOW() WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$size, $id]);
        return $success;
    }
    public function delete_size($id)
    {
        $sql = "DELETE FROM product_size WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    // product start
    public function product_data()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function getimage($id)
    {
        $sql = "SELECT ID,Product_ID,Image_Path FROM product_image WHERE Product_ID=$id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }

    public function product_databyid($id)
    {
        $sql = "SELECT * FROM product WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function subcategory_data($id)
    {
        $sql = "SELECT Subcategory_Name,psc.ID FROM product_subcategory as
        psc LEFT JOIN product_category as pc ON
       psc.Category_ID=pc.ID WHERE psc.Category_ID=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_productdb($data)
    {
        $sql = "INSERT INTO product (Product_Name,Product_Description,Product_Price,Product_Quantity,Product_Color_ID,Product_Size,Category_ID,Subcategory_ID,IsTrending) VALUES (:product_name,:product_desc,:price,:quantity,:color,:size,:category,:subcategory,:trend)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $LAST_ID = $this->conn->lastInsertId();
        return $LAST_ID;
    }
    public function add_imagedb($data, $id)
    {
        $sql = "INSERT INTO product_image (Product_ID,Image_Path) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id, $data]);
        return $success;
    }
    public function update_productdb($data)
    {
        $sql = "UPDATE product SET Product_Name=:product_name,Product_Description=:product_desc,Product_Price=:price,Product_Quantity=:quantity,Product_Color_ID=:color,Product_Size=:size,Category_ID=:category,Subcategory_ID=:subcategory,IsTrending=:trend,Modified_At=NOW() WHERE ID=:id";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute($data);
        return $success;
    }
    public function delete_product($id)
    {
        $sql = "DELETE FROM product WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    public function fetch_image($id)
    {
        $sql = "SELECT ID,Image_Path FROM product_image WHERE Product_ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function fetch_image_table($id)
    {
        $sql = "SELECT ID,Image_Path FROM product_image WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function image_delete($id)
    {
        $sql = "DELETE FROM product_image WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
}
