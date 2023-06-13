<?php
class Expert extends Connection
{
    public function getExpert($email, $password)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertEmail = '$email' AND expertPassword = '$password'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllExpert() {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else  {
            return $result;
        }
    }

    public function getExpertByEmail($email) {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertEmail = '$email'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertExpert($fullname, $email, $username, $password) {
        $connection = $this->getConnection();

        $query = "INSERT INTO expert VALUES (0,'$fullname', '$email', '$password', '$username', NULL, NULL, NULL)";
        ;

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deleteExpert($id) {
        $connection = $this->getConnection();

        $query = "DELETE FROM expert WHERE expertId = '$id'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getPublication($id)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM publication WHERE expertId = '$id'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertExpertPublication($publicationTitle, $publicationCategory)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO publication (publicationTitle, publicationCategory) VALUES (?, ?)";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}
