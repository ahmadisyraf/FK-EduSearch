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

    public function getAllUserOnlineStatusController() {
        return $this->getAllUserOnlineStatus();
    }

    public function getAllExpertOnlineStatusController() {
        return $this->getAllExpertOnlineStatus();
    }

    public function getAllExpertAccountStatusController() {
        return $this->getAllExpertAccountStatus();
    }
}

?>