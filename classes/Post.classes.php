<?php

class Post extends Connection
{
    public function insertPost($uid, $topic, $content, $category, $image)
    {
        $connection = $this->getConnection();


        $query = "INSERT INTO post VALUE (0, $uid, NULL, NULL, '$topic', '$content', '$category', '$image', NULL, NULL)";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllPost() {
        $connection = $this->getConnection();

        $query = "SELECT * FROM POST ORDER BY postDate DESC";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function searchPost($search, $category)
    {
        $connection = $this->getConnection();


        $query = "SELECT * FROM post WHERE (postTopic LIKE '%$search%' OR postContent LIKE '%$search%')";

        if ($category != 'Category' && $category != 'All') {
            $query .= " AND postCategory = '$category'";
        }
    
        $query .= " ORDER BY postDate DESC";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllPostByUserID($userId){
        $connection = $this->getConnection();

        $query = "SELECT * FROM post WHERE userid = '$userId'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deletePostById($postid){
        $connection = $this->getConnection();

        $query = "DELETE FROM post WHERE postid = '$postid'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updatePost($postTopic, $postContent, $postCategory, $image, $postID){
        $connection = $this->getConnection();

        $query = "UPDATE post SET postTopic='$postTopic', postContent='$postContent', postCategory='$postCategory', image='$image' WHERE postid='$postID'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updatePostStatus($status, $expertid, $postID){
        $connection = $this->getConnection();

        $status = mysqli_real_escape_string($connection, $status);
        $expertid = mysqli_real_escape_string($connection, $expertid);
        $postID = mysqli_real_escape_string($connection, $postID);

        $query = "UPDATE post SET postStatus='$status', expertid='$expertid' WHERE postid='$postID'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return true;
        }
    }

    public function getPostByExpertId($expertid){
        $connection = $this->getConnection();

        $query = "SELECT * FROM post WHERE expertid='$expertid'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            return false;
        } else {
            return $result;
        }
    }
}


?>