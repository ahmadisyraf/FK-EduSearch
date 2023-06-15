<?php

class Publication extends Connection
{

    public function insertPublication($title, $date, $category, $userid)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO publication VALUES (NULL, '$userid', '$title', '$date', '$category' )";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getPublication($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM publication WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}

?>