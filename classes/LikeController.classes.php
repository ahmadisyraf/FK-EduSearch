<?php

class LikeController extends Like
{
    public function likeController($uid, $postid) {
        return $this->like($uid, $postid);
    }

    public function unlikeController($likeid){
        return $this->unlike($likeid);
    }

    public function existingLikeController($uid, $postid) {
        return $this->existinglike($uid, $postid);
    }

    public function getLikeByIdController($likeid){
        return $this->getLikeById($likeid);
    }

}

?>