<?php

class Reply extends Connection
{
    public function insertReply($userid, $postId, $reply)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO reply VALUES (NULL, '$userid', '$postId', '$reply', NULL)";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getRepliesByPostId($postId)
    {
        $connection = $this->getConnection();

        $query = "SELECT reply.*, expert.expertFullName, post.postCategory 
          FROM reply 
          INNER JOIN expert ON reply.expertid = expert.expertid 
          INNER JOIN post ON reply.postid = post.postid
          WHERE reply.postid = '$postId'";


        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deleteReply($replyId)
    {
        $connection = $this->getConnection();

        $query = "DELETE FROM reply WHERE replyId = '$replyId'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return true;
        }
    }

}
?>
