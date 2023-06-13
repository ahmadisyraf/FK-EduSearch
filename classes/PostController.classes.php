<?php

class PostController extends Post
{
    public function insertPostController($uid, $topic, $content, $category) {
        return $this->insertPost($uid, $topic, $content, $category);
    }
}

?>