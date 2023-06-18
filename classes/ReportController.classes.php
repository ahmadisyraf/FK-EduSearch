<?php

class ReportController extends Report
{
    public function getAllUserActivityController() {
        return $this->getAllUserActivity();
    }

    public function getPostsByUsernameController($username) {
        return $this->getPostsByUsername($username);
    }

    public function getAllPostController($sort = '') {
        return $this->getAllPost($sort = '');
    }

    public function getNumLikesForUserController($username) {
        return $this->getNumLikesForUser($username);
    }

    public function getNumCommentsForUserController($username) {
        return $this->getNumCommentsForUser($username);
    }
}

?>