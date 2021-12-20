<?php
class Partij extends Connection {
    private array $list = [];

    private ?PDO $conn;

    function __construct() {
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
        } else {
            return false;
        }
    }

    function save($name,$short) {
        $data = [
            'name' => $name,
            'short' => $short,
        ];
        $sql = "INSERT INTO users (name, short) VALUES (:name, :short)";
        $stmt= $this->conn->prepare($sql);

        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    function deletePartij($id) {
        $query = "DELETE FROM `party` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function edit($id) {
        $query = "UPDATE `party` SET `name`,`` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}