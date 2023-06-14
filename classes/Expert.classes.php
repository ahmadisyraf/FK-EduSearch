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

    public function getAllExpert()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertByEmail($email)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertEmail = '$email'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertExpert($fullname, $email, $password, $username)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO expert VALUES (NULL, NULL, NULL, '$fullname', '$email', '$password', '$username', NULL, NULL, NULL)";

        $result = mysqli_query($connection, $query);

        if ($result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateExpert($fullname, $username, $academicstatus, $updateprofilestatus, $accountstatus, $expertid)
    {
        $connection = $this->getConnection();

        $query = "UPDATE expert SET expertFullName = '$fullname', expertUsername = '$username', researchAcademicStatus = '$academicstatus', expertUpdateProfileStatus = '$updateprofilestatus' WHERE expertid = '$expertid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}
?>