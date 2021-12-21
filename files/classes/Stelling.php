<?php
class Stelling extends Connection
{
    private array $list = [];

    private ?PDO $conn;

    function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }

    function getSingle($id): string
    {
        $query = "SELECT * FROM `question` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            $num = $stmt->rowCount();
            if ($num === 1)
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return json_encode([$row['ID'],$row['question']]);
            } else
            {
                return json_encode([]);
            }
        } else
        {
            return false;
        }
    }

    function getList()
    {
        $query = "SELECT * FROM `question`";
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
            } else {
                return [];
            }
        } else {
            return false;
        }
    }

    function addStelling($subject, $question, $parties) {
        $sql = "INSERT INTO `party` (name, short) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([$subject, $question]))
        {

        } else
        {
            return false;
        }
    }

    function deleteQuestion($id): bool
    {
        $query = "DELETE FROM `question` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            return true;
        } else {
            return false;
        }
    }
//
//    function updateStelling() {
//        $query = "DELETE FROM `party` WHERE `ID`=".$id;
//        $stmt = $this->conn->prepare($query);
//
//        if ($stmt->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }
}