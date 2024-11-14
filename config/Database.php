<?php
class Database {

    private $host = 'localhost';
    private $db_name = 'user_authentication_system';
    private $username = 'root';
    private $password = ''; 
    private $conn;

    public function getConnection() {

        $this->conn = null;
        try {

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            // Check the connection
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        
        } catch (Exception $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;

    }

}
?>