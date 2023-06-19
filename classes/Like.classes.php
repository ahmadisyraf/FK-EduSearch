<?php

class Like extends Connection
{
    public function like($uid, $postid)
    {
        $connection = $this->getConnection();


        $query = "INSERT INTO likes VALUES (NULL, '$uid', '$postid')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function unlike($likeid) {
        $connection = $this->getConnection();
    
        $query = "DELETE FROM likes WHERE likeid = '$likeid'";
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
    
    public function existinglike($uid, $postid)
    {
        $connection = $this->getConnection();
    
        $query = "SELECT * FROM likes WHERE userid = '$uid' AND postid = '$postid'";
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getLikeById($likeid){
        $connection = $this->getConnection();
    
        $query = "SELECT * FROM likes WHERE likeid = '$likeid'";
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
    
}


?>