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

        $query = "INSERT INTO user VALUES (NULL, '$fullname', '$email', '$password', '$username', NULL, 'Accepted', 'Offline')";
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

    public function updateUser($userid, $fullname, $email, $password, $username, $userAcademic, $updateprofilestatus)
    {
        $connection = $this->getConnection();

        $query = "UPDATE user SET userFullName='$fullname', userEmail='$email', username='$username', userAcademicStatus='$userAcademic', userUpdateProfileStatus='$updateprofilestatus' WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getUserById($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM user WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateUserOnlineStatus($userid, $status)
    {
        $connection = $this->getConnection();

        $query = "UPDATE user SET userOnlineStatus='$status' WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getTotalUser()
    {
        $connection = $this->getConnection();

        $query = "SELECT COUNT(userid) AS total FROM user";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        }
    }

    public function searchUser($keyword){
        $connection = $this->getConnection();

        $query = "SELECT * FROM user WHERE userFullName LIKE '%" . $keyword . "%'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}

?>