<?php
class ExpertController extends Expert {
    public function getExpertController($email, $password) {
        return $this->getExpert($email, $password);
    }
}

?>