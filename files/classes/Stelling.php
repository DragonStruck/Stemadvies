<?php
class Stelling extends Connection {
    private array $list = [];

    private ?PDO $conn;

    function __construct() {
        $this->conn = $this->connectToDatabase();
    }

    function getList() {
        $query = "SELECT * FROM `question`";
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
        } else {
            return false;
        }
    }

    function save() {

    }

    function deleteQuestion($id) {
        $query = "DELETE FROM `questzion` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit() {
        $query = "DELETE FROM `party` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}