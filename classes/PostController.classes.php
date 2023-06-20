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

    public function getImageByPostIdController($postID){
        return $this->getImageByPostId($postID);
    }

}

?>