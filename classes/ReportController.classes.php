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

    public function getAllPostSummaryController() {
        return $this->getAllPostSummary();
    }

    public function getUserRatingController() {
        return $this->getUserRating();
    }

    public function getExpertRatingController() {
        return $this->getExpertRating();
    }

    public function searchUserExpController($keyword) {
        return $this->searchUserExp($keyword);
    }

    public function searchExpertExpController($keyword) {
        return $this->searchExpertExp($keyword);
    }

    public function searchPostController($keyword) {
        return $this->searchPost($keyword);
    }

}

?>