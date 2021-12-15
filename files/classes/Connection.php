<?php
class Connection {
    private string $host = "localhost";
    private string $database = "stemadvies";
    private string $username = "root";
    private string $password = "";
    private ?PDO $conn;

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