<?php
class AddressModel
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
    public function country_data()
    {
        $sql = "SELECT * FROM country";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_countrydb($country)
    {
        $sql = "INSERT INTO country (Country) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$country]);
        return $success;
    }
    public function update_country($country, $id)
    {
        $sql = "UPDATE country SET Country=?,Modified_At=NOW() WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$country, $id]);
        return $success;
    }
    public function delete_country($id)
    {
        $sql = "DELETE FROM country WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    // state start
    public function state_data()
    {
        $sql = "SELECT x.ID,x.Country_ID,x.State,y.Country,x.Created_At,x.Modified_At
        FROM state as x
        LEFT JOIN country as y
        ON x.Country_ID= y.ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_statedb($cid, $state)
    {
        $sql = "INSERT INTO state (Country_ID,State) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$cid, $state]);
        return $success;
    }
    public function update_state($stateid, $country, $state)
    {
        $sql = "UPDATE state SET Country_ID=?,State=?,Modified_At=NOW() WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$country, $state, $stateid]);
        return $success;
    }
    public function delete_state($id)
    {
        $sql = "DELETE FROM state WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    // city start
    public function city_data()
    {
        $sql = "SELECT x.ID,x.Country_ID,x.State_ID,x.City,y.Country,z.State,x.Created_At,x.Modified_At
           FROM city as x
           LEFT JOIN country as y
           ON x.Country_ID= y.ID
            LEFT JOIN State as z
            ON x.State_ID= z.ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
    public function add_citydb($cid, $sid, $city)
    {
        $sql = "INSERT INTO city (Country_ID,State_ID,City) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$cid, $sid, $city]);
        return $success;
    }
    public function update_city($data)
    {
        $sql = "UPDATE city SET Country_ID=:country_id,State_ID=:state_id,City=:city_name,Modified_At=NOW() WHERE ID=:city_id";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute($data);
        return $success;
    }
    public function delete_city($id)
    {
        $sql = "DELETE FROM city WHERE ID=?";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id]);
        return $success;
    }
    public function state_databyid($id)
    {
        $sql = "SELECT x.ID,x.Country_ID,x.State,y.Country
        FROM state as x
        LEFT JOIN country as y
        ON x.Country_ID= y.ID WHERE x.Country_ID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $success;
    }
}
