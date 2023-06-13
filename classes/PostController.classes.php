<?php

class PostController extends Post
{
    public function insertPostController($uid, $topic, $content, $category, $image) {
        return $this->insertPost($uid, $topic, $content, $category, $image);
    }
}

?>