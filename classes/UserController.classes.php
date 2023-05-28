<?php

class UserController extends User {
    public function InsertUserController($username) {
        return $this->InsertUser($username);
    }

    public function UpdateUserController(){

    }

    public function SelectUserController($tablename, $username) {
        return $this->SelectUser($tablename, $username);
    }

    public function SelectAllUserController() {

    }

    public function DeleteUserController() {

    }

    public function LoginUserController($tablename, $email, $password) {
        return $this->LoginUser($tablename, $email, $password);
    }
}

?>