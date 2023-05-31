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
}

?>