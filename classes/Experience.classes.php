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

    public function getAllUserExperience()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM userexperience";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}

?>