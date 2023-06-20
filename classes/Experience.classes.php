<?php
class Experience extends Connection
{

    public function insertUserExperience($userid, $scale, $description, $recommend, $issueCategory, $issueDescription)
    {
        $connection = $this->getConnection();
        $date = date("Y-m-d H:i:s");

        $query = "INSERT INTO userexperience VALUES (NULL, '$userid', '$scale', '$description', '$recommend', '$issueCategory', '$issueDescription', '$date')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function insertExpertExperience($userid, $scale, $description, $recommend, $issueCategory, $issueDescription)
    {
        $connection = $this->getConnection();
        $date = date("Y-m-d H:i:s");

        $query = "INSERT INTO expertexperience VALUES (NULL, '$userid', '$scale', '$description', '$recommend', '$issueCategory', '$issueDescription', '$date')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllUserExperience()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM userexperience";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllExpertExperience()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expertexperience";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function countUserIssue()
    {
        $connection = $this->getConnection();

        $query = "SELECT COUNT(experienceid) AS total FROM userexperience";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function countExpertIssue()
    {
        $connection = $this->getConnection();

        $query = "SELECT COUNT(expertexperienceid) AS total FROM expertexperience";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getUserBugIssue($category)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM userexperience WHERE issueCategory='$category'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getUserData($category)
    {

        $connection = $this->getConnection();
        $query = "SELECT * FROM user JOIN userexperience ON user.userid = userexperience.userid WHERE userexperience.issueCategory='$category'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllUserData()
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM user JOIN userexperience ON user.userid = userexperience.userid";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertBugIssue($category)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM expertexperience WHERE issueCategory='$category'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertData($category)
    {

        $connection = $this->getConnection();
        $query = "SELECT * FROM expert JOIN expertexperience ON expert.expertid = expertexperience.expertid WHERE expertexperience.issueCategory='$category'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllExpertData()
    {
        $connection = $this->getConnection();
        $query = "SELECT * FROM expert JOIN expertexperience ON expert.expertid = expertexperience.expertid";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }


}

?>