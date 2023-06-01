<?php

class AdminController extends Admin {

    public function getAdminController($email, $password) {
            return $this->getAdmin($email, $password);
    }

    public function insertAdminController($fullname, $email, $password, $username) {
        return $this->insertAdmin($fullname, $email, $password, $username);
    }
}

?>