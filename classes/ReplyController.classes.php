<?php

class ReplyController extends Reply
{
    public function insertReplyController($userid, $postId, $reply)
    {
        return $this->insertReply($userid, $postId, $reply);
    }

    public function getRepliesByPostIdController($postId)
    {
        return $this->getRepliesByPostId($postId);
    }

    public function deleteReplyByReplyIdController($replyId)
    {
        return $this->deleteReply($replyId);
    }
    
}
?>
