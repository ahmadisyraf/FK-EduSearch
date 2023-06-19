<?php

class CommentController extends Comment
{
    public function insertCommentController($uid, $postid, $comment) {
        return $this->insertComment($uid, $postid, $comment);
    }

    public function getCommenntByPostIdController($postid){
        return $this->getCommenntByPostId($postid);
    }

}

?>