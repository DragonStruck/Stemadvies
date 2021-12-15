<?php
class Partij extends Connection
{
    private ?PDO $conn;

    function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }

}