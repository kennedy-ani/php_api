<?php
class Database {
    // database params
    private $host = "localhost";
    private $db_name = "rest_blog";
    private $user_name = "root";
    private $password = "";
    private $conn;

    // database connect method
    public function connect() {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=". $this->host . ";dbname=".$this->db_name, 
            $this->user_name, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Connection Failed: ".$e->getMessage();
        }

        return $this->conn;
    }
}
?>