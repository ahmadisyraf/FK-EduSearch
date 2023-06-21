<?php

class PostController extends Post
{
    public function insertPostController($uid, $topic, $content, $category, $image) {
        return $this->insertPost($uid, $topic, $content, $category, $image);
    }

    public function getAllPostController() {
        return $this->getAllPost();
    }

    public function searchPostController($search, $category){
        return $this->searchPost($search, $category);
    }

    public function getAllPostByUserIDController($userId){
        return $this->getAllPostByUserID($userId);
    }

    public function deletePostByIdController($postid){
        return $this->deletePostById($postid);
    }

    public function updatePostController($postTopic, $postContent, $postCategory, $image, $postID){
        return $this->updatePost($postTopic, $postContent, $postCategory, $image, $postID);
    }

    public function updatePostStatusController($status, $expertid, $postID){
        return $this->updatePostStatus($status, $expertid, $postID);
    }

    public function getPostByExpertIdController($expertid){
        return $this->getPostByExpertId($expertid);
    }

    public function insertRatingController($userid, $replyid, $rate){
        return $this->insertRating($userid, $replyid, $rate);
    }

    public function getRateController($replyid) {
        return $this->getRate($replyid);
    }

}

?>