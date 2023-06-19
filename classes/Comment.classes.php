<?php

class Comment extends Connection
{
    public function insertComment($uid, $postid, $comment)
    {
        $connection = $this->getConnection();


        $query = "INSERT INTO comment VALUES (NULL, '$uid', '$postid', '$comment')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}


?>