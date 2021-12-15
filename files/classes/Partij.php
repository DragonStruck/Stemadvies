<?php
class Partij extends Connection
{
    private array $list = [];

    private ?PDO $conn;

    function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }

    function getList() {
        $query = "SELECT * FROM `party`";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $num = $stmt->rowCount();
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($this->list, $row);
                }
                return $this->list;
            } else {
                return [];
            }
        }
    }
}