<?php

class Post extends Connection
{
    public function insertPost($uid, $topic, $content, $category, $image)
    {
        $connection = $this->getConnection();

        $date = date("Y-m-d");

        $query = "INSERT INTO post VALUE (0, $uid, NULL, '$topic', '$content', '$category', '$image', '$date', NULL)";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}


?>