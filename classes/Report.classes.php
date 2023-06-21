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

    public function getAllPostSummary()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM post";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getUserRating()
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

    public function getExpertRating()
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

    public function getUserExp()
    {
        $connection = $this->getConnection();

        $query = "SELECT user.username, userexperience.scale, userexperience.description, userexperience.recommend, userexperience.submitDate
        FROM userexperience
        INNER JOIN user ON userexperience.userid=user.userid";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getExpertExp()
    {
        $connection = $this->getConnection();

        $query = "SELECT expert.expertUsername, expertexperience.scale, expertexperience.description, expertexperience.recommend, expertexperience.submitDate
        FROM expertexperience
        INNER JOIN expert ON expertexperience.expertid=expert.expertid";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function searchUserExp($keyword)
    {
        $connection = $this->getConnection();

        $query = "SELECT user.username, userexperience.scale, userexperience.description, userexperience.recommend, userexperience.submitDate
        FROM userexperience
        INNER JOIN user ON userexperience.userid=user.userid
        WHERE user.username LIKE '%" . $keyword . "%' OR userexperience.scale LIKE '%" . $keyword . "%' OR userexperience.description LIKE '%" . $keyword . "%'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function searchExpertExp($keyword)
    {
        $connection = $this->getConnection();

        $query = "SELECT expert.expertUsername, expertexperience.scale, expertexperience.description, expertexperience.recommend, expertexperience.submitDate
        FROM expertexperience
        INNER JOIN expert ON expertexperience.expertid=expert.expertid
        WHERE expert.expertUsername LIKE '%" . $keyword . "%' OR expertexperience.scale LIKE '%" . $keyword . "%' OR expertexperience.description LIKE '%" . $keyword . "%'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function searchPost($keyword)
    {
        $connection = $this->getConnection();

        $query = $query = "SELECT * FROM post WHERE postTopic LIKE '%" . $keyword . "%' OR postContent LIKE '%" . $keyword . "%' OR postCategory LIKE '%" . $keyword . "%' OR postDate LIKE '%" . $keyword . "%'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

}


?>