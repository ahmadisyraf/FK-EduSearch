<?php

class Admin extends Connection
{
    public function getAdmin($email, $password)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM admin WHERE adminEmail = '$email' AND adminPassword = '$password'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllAdmin()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM admin";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertAdmin($fullname, $email, $username, $password)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO user VALUES (0,'$fullname', '$email', '$password', '$username', NULL, NULL, NULL)";
        ;

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}

?>