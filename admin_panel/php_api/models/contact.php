<?php
class Contact
{
    // DB Stuff
    private $conn;
    private $table = 'contact';

    // Properties
    public $name;
    public $email;
    public $subject;
    public $message;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get categories
    public function add_contact()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' (Name,Email,Subject,Message) VALUES (:name,:email,:subject,:message)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->message = htmlspecialchars(strip_tags($this->message));
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':message', $this->message);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
