<?php

class AdminController extends Admin {
    public function getAdminController($email, $password) {
        return $this->getAdmin($email, $password);
    }
}

?>