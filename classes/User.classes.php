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
}

?>