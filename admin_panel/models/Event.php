<?php
class EventModel
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
    public function check_admin($admin_data)
    {
        $sql = "SELECT * FROM admin_details WHERE UserName=:UserName";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($admin_data);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function getuser_count()
    {
        $sql = "SELECT count(*) AS TOTAL_USER FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function getproduct_count()
    {
        $sql = "SELECT count(*) AS TOTAL_PRODUCT FROM product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function get_slider()
    {
        $sql = "SELECT * FROM slider";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_slider($data){
        $sql = "INSERT INTO slider (Description,Image_Path,Created_At) VALUES (:description,:image_path,NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
    public function remove_slider($id){
        $sql = "DELETE FROM slider WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute([$id]);
        return $success;
    }
    public function add_coupan_db($data){
        $sql = "INSERT INTO product_coupan (Discount,Created_At,Coupan_ID,Expiry) VALUES (:discount,NOW(),:coupan,:expiry)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
    public function get_coupan()
    {
        $sql = "SELECT * FROM product_coupan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function remove_coupan($id){
        $sql = "DELETE FROM product_coupan WHERE Coupan_ID=?";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute([$id]);
        return $success;
    }
    //testimonial
    public function get_testimonial()
    {
        $sql = "SELECT * FROM testimonial";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function get_testimg($id)
    {
        $sql = "SELECT Image_Path FROM testimonial WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_testimonial($data){
        $sql = "INSERT INTO testimonial (Name,Image_Path,Description,Designation,Created_At) VALUES (:name,:image_path,:description,:designation,NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
    public function update_testimonial($data){
        $sql = "UPDATE testimonial SET Name=:name,Image_Path=:image_path,Description=:description,Designation=:designation,Modified_At=NOW() WHERE ID=:id";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute($data);
        return $success;
    }
    public function remove_testimonial($id){
        $sql = "DELETE FROM testimonial WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute([$id]);
        return $success;
    }
    //about ck editor
    public function add_about($data){
        $sql = "UPDATE about SET data='.$data.',Modified_At=NOW() WHERE ID=1";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        return $success;
    }
    public function get_about(){
        $sql = "SELECT * FROM about";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    //contact start
    public function get_contact(){
        $sql = "SELECT * FROM contact";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function send_reply($reply,$email_user){
        require "vendor/autoload.php";
        include "stripe.php";
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("comicbykenil@gmail.com", "Ecommerce");
        $email->setSubject("Response to your query !!!");
        $email->addTo($email_user);
        $email->addContent("text/html","<p>$reply</p>");
        $sendgrid = new \SendGrid($sendgrid_key);
        $success=$sendgrid->send($email);
        if($success){
            return true;
        }else{
            return false;
        }
       
    }
    public function save_reply($data){
        $sql = "UPDATE contact SET Reply=:reply,Modified_At=NOW() WHERE ID=:id";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute($data);
        return $success;
    }
    //pending order count
    public function pending_count()
    {
        $sql = "SELECT count(*) AS pending_count FROM order_details WHERE Status=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    //complete order count
    public function complete_count()
    {
        $sql = "SELECT count(*) AS complete_count FROM order_details WHERE Status=2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
      //product review start
      public function get_productrv(){
        $sql = "SELECT pr.*,CONCAT(user.FirstName,' ',user.LastName) AS FullName,product.Product_Name FROM product_review as pr LEFT JOIN user ON pr.User_ID=user.ID LEFT JOIN product ON pr.Product_ID=product.ID";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function remove_rv($id){
        $sql = "DELETE FROM product_review WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute([$id]);
        return $success;
    }
    //newsletter start
    public function get_newsletter(){
        $sql = "SELECT * FROM all_newsletter";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function send_newsletter($title,$desc){
        $sql = "SELECT Email FROM user_newsletter";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require "vendor/autoload.php";
        include "stripe.php";
        foreach($success as $val){
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("comicbykenil@gmail.com", "Ecommerce");
            $email->setSubject($title);
            $email->addTo($val['Email']);
            $email->addContent("text/html","<p>$desc</p>");
            $sendgrid = new \SendGrid($sendgrid_key);
            $success=$sendgrid->send($email);
            
        }  
        if($success){
            return true;
        }else{
            return false;
        }
    }
    public function save_newsletter($data){
        $sql = "INSERT INTO all_newsletter (Title,Description,Created_At) VALUES (:title,:desc,NOW())";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute($data);
        return $success;
    }
    public function get_newsletteruser(){
        $sql = "SELECT * FROM user_newsletter";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function remove_nl($id){
        $sql = "DELETE FROM all_newsletter WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success=$stmt->execute([$id]);
        return $success;
    }
}
