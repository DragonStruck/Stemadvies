<?php

class Answer
{
    private $list = [];

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function getAgree($questionID) {
        $query = "SELECT partyID FROM `answer` WHERE questionID = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$questionID]);
        return $stmt;

//        $stmt= $this->conn->prepare($query);
//        if ($stmt->execute([$questionID]))
//        {
//            $num = $stmt->rowCount();
//            if ($num > 0)
//            {
//                while ($row = $stmt->fetchColumn(0))
//                {
//                    array_push($this->list, $row);
//                }
//                return $this->list;
//            } else {
//                return [];
//            }
//        } else {
//            return false;
//        }
    }

    function getAgreeList() {
        $query = "SELECT partyID,questionID FROM `answer` ORDER BY questionID ASC";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            $num = $stmt->rowCount();
            if ($num > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    array_push($this->list, $row);
                }
                return $this->list;
            } else
            {
                return [];
            }
        } else
        {
            return false;
        }
    }

    function checkAgree($questionID,$partyID) {
        $query = "SELECT partyID FROM answer WHERE questionID = ? AND partyID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$questionID,$partyID]);
        return $stmt;
    }
}