<?php
require "../../JWT/vendor/autoload.php";

use \Firebase\JWT\JWT;

class User
{
    // DB Stuff
    private $conn;
    private $table = 'user';

    // Properties
    public $ID;
    public $UserName;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Password;
    public $Mobile;
    public $Phone;
    public $Gender;
    public $Intrest;
    public $country_ship;
    public $city_ship;
    public $state_ship;
    public $street_ship;
    public $address_type;
    public $country_bill;
    public $city_bill;
    public $state_bill;
    public $street_bill;



    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create user
    public function create()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '(UserName, FirstName, LastName, Email, Password, Gender, Phone, Mobile, Intrest,Created_At,Modified_At,Status)
     VALUES (:UserName,:FirstName,:LastName,:Email,:Password,:Gender,:Phone,:Mobile,:Intrest,NOW(),NOW(),1)';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
        $this->LastName = htmlspecialchars(strip_tags($this->LastName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Gender = htmlspecialchars(strip_tags($this->Gender));
        $this->Mobile = htmlspecialchars(strip_tags($this->Mobile));
        $this->Phone = htmlspecialchars(strip_tags($this->Phone));
        $this->Intrest = htmlspecialchars(strip_tags($this->Intrest));

        // Bind data
        $stmt->bindParam(':UserName', $this->UserName);
        $stmt->bindParam(':FirstName', $this->FirstName);
        $stmt->bindParam(':LastName', $this->LastName);
        $stmt->bindParam(':Email', $this->Email);
        $stmt->bindParam(':Password', $this->Password);
        $stmt->bindParam(':Gender', $this->Gender);
        $stmt->bindParam(':Mobile', $this->Mobile);
        $stmt->bindParam(':Intrest', $this->Intrest);
        $stmt->bindParam(':Phone', $this->Phone);

        if ($stmt->execute()) {
            return true;
        }
    }
    // Create user
    public function check()
    {
        // Create Query
        $query = 'SELECT count(*) AS count FROM user WHERE UserName =:UserName';
        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        // Bind data
        $stmt->bindParam(':UserName', $this->UserName);
        $stmt->execute();
        return $stmt;
    }
    public function check_login()
    {
        // Create Query
        $query = 'SELECT * FROM user WHERE UserName =:UserName';
        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        // Bind data
        $stmt->bindParam(':UserName', $this->UserName);

        $stmt->execute();
        return $stmt;
    }
    public function check_email()
    {
        // Create Query
        $query = 'SELECT count(*) AS count FROM user WHERE Email =:Email';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Email', $this->Email);
        $stmt->execute();
        return $stmt;
    }
    public function get_user($ID)
    {
        // Create Query
        $query = 'SELECT * FROM user WHERE ID =' . $ID . '';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function get_useraddress($ID)
    {
        // Create Query
        $query = 'SELECT * FROM user_address WHERE User_ID =' . $ID . '';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function check_address_billing($ID)
    {
        // Create Query
        $query = 'SELECT count(*) as count FROM user_address WHERE User_ID =' . $ID . ' AND Address_Type="Billing"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function check_address_shipping($ID)
    {
        // Create Query
        $query = 'SELECT count(*) as count FROM user_address WHERE User_ID =' . $ID . ' AND Address_Type="Shipping"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function update_address_billing($ID)
    {
        // update Query
        $query = 'UPDATE user_address SET Street=:Street,Country_ID=:Country_ID,State_ID=:State_ID,City_ID=:City_ID WHERE User_ID=:User_ID  AND Address_Type="Billing"';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Street', $this->street_bill);
        $stmt->bindParam(':Country_ID', $this->country_bill);
        $stmt->bindParam(':State_ID', $this->state_bill);
        $stmt->bindParam(':City_ID', $this->city_bill);
        $stmt->bindParam(':User_ID', $ID);
        $stmt->execute();
        return $stmt;
    }
    public function create_address_billing($ID)
    {
        // Create Query
        $query = 'INSERT INTO user_address (User_ID,Street,Country_ID,State_ID,City_ID,Address_Type) VALUES (:User_ID,:Street,:Country_ID,:State_ID,:City_ID,"Billing")';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Street', $this->street_bill);
        $stmt->bindParam(':Country_ID', $this->country_bill);
        $stmt->bindParam(':State_ID', $this->state_bill);
        $stmt->bindParam(':City_ID', $this->city_bill);
        $stmt->bindParam(':User_ID', $ID);
        $stmt->execute();
        return $stmt;
    }
    public function update_address_shipping($ID)
    {
        // update Query
        // print_r($this->street_bill); print_r($this->street_ship);die();
        $query = 'UPDATE user_address SET Street=:Street,Country_ID=:Country_ID,State_ID=:State_ID,City_ID=:City_ID WHERE User_ID=:User_ID AND Address_Type="Shipping"';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Street', $this->street_ship);
        $stmt->bindParam(':Country_ID', $this->country_ship);
        $stmt->bindParam(':State_ID', $this->state_ship);
        $stmt->bindParam(':City_ID', $this->city_ship);
        $stmt->bindParam(':User_ID', $ID);
        $stmt->execute();
        return $stmt;
    }
    public function create_address_shipping($ID)
    {
        // Create Query
        $query = 'INSERT INTO user_address (User_ID,Street,Country_ID,State_ID,City_ID,Address_Type) VALUES (:User_ID,:Street,:Country_ID,:State_ID,:City_ID,"Shipping")';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Street', $this->street_ship);
        $stmt->bindParam(':Country_ID', $this->country_ship);
        $stmt->bindParam(':State_ID', $this->state_ship);
        $stmt->bindParam(':City_ID', $this->city_ship);
        $stmt->bindParam(':User_ID', $ID);
        $stmt->execute();
        return $stmt;
    }
    public function update()
    {
        // Create Query
        $query = 'UPDATE ' . $this->table . ' SET UserName=:UserName, FirstName=:FirstName, LastName=:LastName, Email=:Email, Password=:Password, Gender=:Gender, Phone=:Phone, Mobile=:Mobile WHERE ID=:ID';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
        $this->LastName = htmlspecialchars(strip_tags($this->LastName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Gender = htmlspecialchars(strip_tags($this->Gender));
        $this->Mobile = htmlspecialchars(strip_tags($this->Mobile));
        $this->Phone = htmlspecialchars(strip_tags($this->Phone));
        // $this->ID = htmlspecialchars(strip_tags($this->ID));

        // Bind data
        $stmt->bindParam(':UserName', $this->UserName);
        $stmt->bindParam(':ID', $this->ID);
        $stmt->bindParam(':FirstName', $this->FirstName);
        $stmt->bindParam(':LastName', $this->LastName);
        $stmt->bindParam(':Email', $this->Email);
        $stmt->bindParam(':Password', $this->Password);
        $stmt->bindParam(':Gender', $this->Gender);
        $stmt->bindParam(':Mobile', $this->Mobile);
        // $stmt->bindParam(':Intrest', $this->Intrest);
        $stmt->bindParam(':Phone', $this->Phone);

        if ($stmt->execute()) {
            return true;
        }
    }
    public function check_password($id)
    {
        $query = 'SELECT * FROM user WHERE ID=' . $id . ' ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function update_password($id, $password)
    {
        $query = 'UPDATE user SET Password=?,Modified_At=NOW() WHERE ID=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        return $stmt;
    }
    public function update_password_email($email,$password)
    {
        $query = 'UPDATE user SET Password=?,Modified_At=NOW() WHERE Email=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $email);
        $stmt->execute();
        return $stmt;
    }
    public function send_otp($email_user, $random)
    {
        require "../../../models/vendor/autoload.php";
        require "../../../models/stripe.php";
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("comicbykenil@gmail.com", "Ecommerce");
        $email->setSubject("Forgot password otp!!!");
        $email->addTo($email_user);
        $email->addContent("text/html", "<h2>Your OTP IS</h2> &nbsp;<strong>$random</strong>");
        $sendgrid = new \SendGrid($sendgrid_key);
        $success = $sendgrid->send($email);
        if ($success) {
            return true;
        } else {
            return false;
        }
    }
    public function add_otp($email, $otp)
    {
        $query = 'INSERT INTO forgot_password (Email,OTP) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $otp);
        $stmt->execute();
        return $stmt;
    }
    public function check_otp($email, $otp)
    {
        $query = 'SELECT * FROM forgot_password WHERE Email=? AND OTP=? AND IsExpire=0';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $otp);
        $stmt->execute();
        return $stmt;
    }
    //set expire otp
    public function select_datetime($email,$otp)
    {
        $query = 'SELECT Created_At FROM forgot_password WHERE Email=? AND OTP= ? AND IsExpire=0';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $otp);
        $stmt->execute();
        return $stmt;
    }
    public function modify_otp($email)
    {
        $query = "UPDATE forgot_password SET IsExpire=1 WHERE Email=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt;
    }
    public function check_extra_otp($email)
    {
        $query = 'SELECT count(*) as count FROM forgot_password WHERE Email=? AND IsExpire=0';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt;
    }
    //newsletter
    public function check_nl($email)
    {
        $query = 'SELECT * FROM user_newsletter WHERE Email=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt;
    }
    public function add_nl($email)
    {
        $query = 'INSERT INTO user_newsletter (Email,Created_At) VALUES (?,NOW())';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $success=$stmt->execute();
        return $success;
    }
}
