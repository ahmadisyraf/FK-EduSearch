<?php

class Reply extends Connection
{
    public function insertReply($userid, $postId, $reply)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO reply VALUES (NULL, '$userid', '$postId', NULL, NULL, '$reply')";

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

        $query = "SELECT reply.*, expert.expertFullName 
          FROM reply 
          INNER JOIN expert ON reply.expertid = expert.expertid 
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
