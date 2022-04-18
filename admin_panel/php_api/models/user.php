<?php
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


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create Category
    public function create()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '(UserName, FirstName, LastName, Email, Password, Gender, Phone, Mobile, Intrest,Created_At,Modified_At)
     VALUES (:UserName,:FirstName,:LastName,:Email,:Password,:Gender,:Phone,:Mobile,:Intrest,NOW(),NOW())';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->FirstName = htmlspecialchars(strip_tags($this->FirstName));
        $this->LastName = htmlspecialchars(strip_tags($this->LastName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
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
}
