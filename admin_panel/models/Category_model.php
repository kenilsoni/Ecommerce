<?php
class CategoryModel
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

    public function category_data()
    {
        $sql = "SELECT * FROM product_category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function addcategory_data($name, $desc)
    {
        $sql = "INSERT INTO `product_category`( `Category_Name`,`Category_desc`) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$name, $desc]);
        return $success;
    }
    public function delete_category($id)
    {
        $sql = "DELETE FROM `product_category` WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    public function update_category($data)
    {
        $sql = "UPDATE `product_category` SET `Category_Name`=:Category_Name,`Category_desc`=:desc_category,`Modified_At`=NOW() WHERE `ID`=:ID";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute($data);
        return $success;
    }
    public function desc_data($id)
    {
        $sql = "SELECT Category_desc FROM product_category WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
}
