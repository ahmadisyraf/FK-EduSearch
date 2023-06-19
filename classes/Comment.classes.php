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

    public function getCommenntByPostId($postid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM comment WHERE postid='$postid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}


?>