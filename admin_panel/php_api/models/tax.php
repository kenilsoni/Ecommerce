<?php
  class Tax {
    // DB Stuff
    private $conn;
    private $table = 'service_tax';

    // Properties
    public $ID;
    public $tax_percent;
    public $Country_ID;
    public $State_ID;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get size
    public function country() {
      // Create query
      $query = 'SELECT DISTINCT ctry.Country,stax.Country_ID FROM service_tax as stax LEFT JOIN country as ctry ON stax.Country_ID=ctry.ID
      LEFT JOIN state as st ON stax.State_ID=st.ID';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function state($id) {
        // Create query
        $query = 'SELECT DISTINCT st.State,stax.State_ID,stax.tax_percent FROM service_tax as stax LEFT JOIN country as ctry ON stax.Country_ID=ctry.ID
        LEFT JOIN state as st ON stax.State_ID=st.ID WHERE stax.Country_ID='.$id.'';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }
  

  

}