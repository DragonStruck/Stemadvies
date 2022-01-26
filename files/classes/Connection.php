<?php
class Connection {
    private $host = "localhost";
    private $database = "student4a9_544194";
    private $username = "student4a9_544194";
    private $password = "DjWzUE";
    private $conn;

    public function connectToDatabase(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}