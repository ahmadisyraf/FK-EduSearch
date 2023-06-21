<?php

class Report extends Connection
{
    public function getAllUserActivity()
    {
        $connection = $this->getConnection();

        $query = "SELECT user.username, post.postTopic
        FROM post
        INNER JOIN user ON post.userid=user.userid";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getPostsByUsername($username)
    {
        $connection = $this->getConnection();

        $query = "SELECT user.username, post.postTopic, post.postContent, post.postCategory, post.postDate
        FROM post
        INNER JOIN user ON post.userid=user.userid
        WHERE user.username = '$username'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllPost($sort = '')
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM post";

        if ($sort == 'day') {
            $query .= " ORDER BY postDate DESC";
        } elseif ($sort == 'week') {
            $query .= " ORDER BY YEARWEEK(postDate) DESC";
        } elseif ($sort == 'year') {
            $query .= " ORDER BY YEAR(postDate) DESC";
        }

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    function getNumLikesForUser($username)
    {
        // Perform a database query to fetch the number of likes for the given post ID
        // Replace the following code with your actual implementation
        $connection = $this->getConnection();

        $query = "SELECT user.username, COUNT(likes.likeid) AS likeCount
        FROM likes
        INNER JOIN user ON likes.userid = user.userid
        WHERE user.username = '$username'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    function getNumCommentsForUser($username)
    {
        // Perform a database query to fetch the number of likes for the given post ID
        // Replace the following code with your actual implementation
        $connection = $this->getConnection();

        $query = "SELECT user.username, COUNT(comment.commentid) AS commentCount
        FROM comment
        INNER JOIN user ON comment.userid = user.userid
        WHERE user.username = '$username'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllUserOnlineStatus()
    {
        $connection = $this->getConnection();

        $query = "SELECT userid, userOnlineStatus FROM user";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllExpertOnlineStatus()
    {
        $connection = $this->getConnection();

        $query = "SELECT expertid, expertOnlineStatus FROM expert";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAllExpertAccountStatus()
    {
        $connection = $this->getConnection();

        $query = "SELECT expertid, expertAccountStatus FROM expert";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

}


?>