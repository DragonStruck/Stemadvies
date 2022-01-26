<?php
class Partij
{
    private $list = [];

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    function getSingle($id): string
    {
        $query = "SELECT * FROM `party` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            $num = $stmt->rowCount();
            if ($num === 1)
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return json_encode([$row['ID'],$row['name'],$row['short']]);
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
        $query = "SELECT * FROM `party`";
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

    function addPartij($name,$short)
    {
        $sql = "INSERT INTO `party` (name, short) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([$name, $short]))
        {
            return true;
        } else
        {
            return false;
        }
    }

    function deletePartij($id): bool
    {
        $query = "DELETE FROM `party` WHERE `ID`=".$id;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            return true;
        } else
        {
            return false;
        }
    }

    function updatePartij($id, $name, $short)
    {
        $query = "UPDATE `party` SET name=?, short=? WHERE id=?";
        $stmt= $this->conn->prepare($query);

        if ($stmt->execute([$name, $short, $id]))
        {
            return true;
        } else
        {
            return false;
        }
    }
}