<?php

class Post extends Connection
{
    public function insertPost($uid, $topic, $content, $category, $image)
    {
        $connection = $this->getConnection();


        $query = "INSERT INTO post VALUE (0, $uid, NULL, '$topic', '$content', '$category', '$image', NULL, NULL)";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllPost() {
        $connection = $this->getConnection();

        $query = "SELECT post.*, likes.likeid
                FROM post
                LEFT JOIN likes
                ON post.postid = likes.postid
                ORDER BY postDate DESC";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}


?>