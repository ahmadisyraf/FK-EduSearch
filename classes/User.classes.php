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

    public function getAllUser()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getUserByEmail($email)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user WHERE userEmail = '$email'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertUser($fullname, $email, $username, $password)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO user VALUES (NULL, NULL, '$fullname', '$email', '$password', '$username', NULL, NULL)";
        ;

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deleteUser($id)
    {
        $connection = $this->getConnection();

        $query = "DELETE FROM user WHERE userid = '$id'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            mysqli_close($connection);
            return $result;
        }

    }

    public function updateUser($fullname, $email, $password, $username) {
        $connection = $this->getConnection();

        $query = "UPDATE user SET userFullName='$fullname', userEmail='$email', userPassword='$password', username='$username'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            mysqli_close($connection);
            return $result;
        }
    }
}

?>