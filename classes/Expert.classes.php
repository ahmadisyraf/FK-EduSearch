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

    public function insertExpert($fullname, $email, $password, $username, $status)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO expert VALUES (NULL, '$fullname', '$email', '$password', '$username', NULL, NULL, 'Accepted', 'Active', 'Offline')";

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

    public function updateExpertOnlineStatus($userid, $status)
    {
        $connection = $this->getConnection();

        $query = "UPDATE expert SET expertOnlineStatus='$status' WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateExpertLastLogin($userid, $lastlogin)
    {
        $connection = $this->getConnection();

        $query = "UPDATE expertlogin SET expertLastLoginDate='$lastlogin' WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertExpertLastLogin($userid, $lastlogin) {
        $connection = $this->getConnection();

        $query = "INSERT INTO expertlogin VALUES (NULL, '$userid', '$lastlogin')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertById($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertid = '$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertLastLogin($userid) {
        $connection = $this->getConnection();

        $query = "SELECT expertLastLoginDate FROM expertlogin WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertAccountStatus($userid) {
        $connection = $this->getConnection();

        $query = "SELECT expertAccountStatus FROM expert WHERE expertid='$userid'";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateExpertAccountStatus($userid, $status) {
        $connection = $this->getConnection();

        $query = "UPDATE expert SET expertAccountStatus='$status' WHERE expertid='$userid'";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getTotalExpert() {
        $connection = $this->getConnection();

        $query = "SELECT COUNT(expertid) AS total FROM expert";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        }
    }

    public function searchExpert($keyword){
        $connection = $this->getConnection();

        $query = "SELECT * FROM expert WHERE expertFullName LIKE '%" . $keyword . "%'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}
?>