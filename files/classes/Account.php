<?php
class Account extends Connection
{
    private $username;
    private $password;

    private $conn;

    function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }

    public function Login($username, $password): bool
    {
        $this->username = $username;
        $this->password = $password;

        $_SESSION['username'] = $this->username;

        $query = 'SELECT * FROM `admin` WHERE `username` = "' . $this->username . '"';
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $num = $stmt->rowCount();
            if ($num == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($this->password, $row['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['userID'] = $row['ID'];

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}