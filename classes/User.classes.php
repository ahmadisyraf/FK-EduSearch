<?php

class User extends Connection
{
    public function getUser($email, $password)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user WHERE userEmail = '$email' AND userPassword = '$password'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllUser() {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else  {
            return $result;
        }
    }

    public function getUserByEmail($email) {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user WHERE userEmail = '$email'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertUser($fullname, $email, $username, $password) {
        $connection = $this->getConnection();

        $query = "INSERT INTO user VALUES (0,'$fullname', '$email', '$password', '$username', NULL, NULL, NULL)";;

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}

?>