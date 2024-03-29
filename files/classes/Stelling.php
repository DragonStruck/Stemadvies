<?php
class Stelling
{
    private $list = [];

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
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
                return json_encode([$row['ID'],$row['subject'],$row['question']]);
            } else
            {
                return json_encode([]);
            }
        } else
        {
            return false;
        }
    }

    function getList() {
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
        $query1 = "INSERT INTO `question` (subject, question) VALUES (?,?)";
        $stmt1 = $this->conn->prepare($query1);

        if ($stmt1->execute([$subject, $question]))
        {
            $query2 = "SELECT MAX(id) as ID FROM `question`";
            $stmt2 = $this->conn->prepare($query2);
            if ($stmt2->execute()) {
                $num = $stmt2->rowCount();
                if ($num === 1)
                {
                    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $id = $row['ID'];
                    $exec = [];

                    for ($i = 0; $i < sizeof($parties); $i++) {
                        array_push($exec, ["questionID" => $id, "partyID" => $parties[$i]]);
                    }

                    if ($this->pdoMultiInsert('answer', $exec, $this->conn)) {
                        return "true";
                    }
                }
            }
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


    function updateStelling($questionID, $subject, $question, $parties) {
        if ($this->deleteAnswers($questionID) == true) {

            $query1 = "UPDATE `question` SET subject=?, question=? WHERE id=?";
            $stmt1 = $this->conn->prepare($query1);

            if ($stmt1->execute([$subject, $question, $questionID]))
            {
                $exec = [];

                for ($i = 0; $i < sizeof($parties); $i++) {
                    array_push($exec, ["questionID" => $questionID, "partyID" => $parties[$i]]);
                }

                if ($this->pdoMultiInsert('answer', $exec, $this->conn)) {
                    return "true";
                }
            } else
            {
                return false;
            }
        } else {
            return false;
        }
    }

    function getParties($questionID) {
        $query = "SELECT `partyID` FROM `answer` WHERE `questionID`=".$questionID;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            $num = $stmt->rowCount();
            if ($num > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    array_push($this->list, $row['partyID']);
                }
                return json_encode($this->list);
            } else {
                return json_encode([]);
            }
        } else {
            return false;
        }
    }

    function deleteAnswers($questionID) {
        $query = "DELETE FROM `answer` WHERE `questionID`=".$questionID;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute())
        {
            return true;
        } else {
            return false;
        }
    }

    function pdoMultiInsert($tableName, $data, $pdoObject){
        $rowsSQL = [];
        $toBind = [];

        $columnNames = array_keys($data[0]);

        foreach($data as $arrayIndex => $row){
            $params = [];
            foreach($row as $columnName => $columnValue){
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue;
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }

        $sql = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);
        $pdoStatement = $pdoObject->prepare($sql);

        foreach($toBind as $param => $val){
            $pdoStatement->bindValue($param, $val);
        }

        return $pdoStatement->execute();
    }
}