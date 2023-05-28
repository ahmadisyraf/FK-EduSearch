<?php

class User extends Connection {
    protected function InsertUser($username) {
        $connection = $this->getConnection();

        $query = "INSERT INTO user VALUES ('0', '$username')";

        
        $result = mysqli_query($connection, $query);

        if(!$result) {
            echo "Error: " .mysqli_error($connection);
        } else {
            return $result;
        }

        mysqli_close($connection);
    }

    protected function SelectUser($tablename, $username) {
        $connection = $this->getConnection();

        $query = "SELECT * FROM '$tablename' WHERE username='$username'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            echo "Error: " .mysqli_error($connection);
        } else {
            return $result;
        }

        mysqli_close($connection);
    }

    protected function LoginUser($tablename, $email, $password) {
        $connection = $this->getConnection();

        $query = "SELECT * FROM '$tablename' WHERE email='$email' AND password='$password'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            echo "Error: " .mysqli_error($connection);
        } else {
            return $result;
        }

        mysqli_close($connection);
    }
}

?>