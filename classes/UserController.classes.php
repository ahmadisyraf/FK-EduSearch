<?php

class UserController extends User {
    public function getUserController($email, $password) {
        return $this->getUser($email, $password);
    }

    public function getAllUserController() {
        return $this->getAllUser();
    }

    public function getUserByEmailController($email) {
        return $this->getUserByEmail($email);
    }
}

?>