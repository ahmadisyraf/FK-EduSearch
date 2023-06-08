<?php
class ExpertController extends Expert {
    public function getExpertController($email, $password) {
        return $this->getExpert($email, $password);
    }

    public function getAllExpertController() {
        return $this->getAllExpert();
    }

    public function getExpertByEmailController($email) {
        return $this->getExpertByEmail($email);
    }

    public function insertExpertController($fullname, $email, $password, $username) {
        return $this->insertExpert($fullname, $email, $password, $username);
    }
}

?>