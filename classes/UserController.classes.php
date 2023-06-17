<?php

class UserController extends User
{
    public function getUserController($email, $password)
    {
        return $this->getUser($email, $password);
    }

    public function getAllUserController()
    {
        return $this->getAllUser();
    }

    public function getUserByEmailController($email)
    {
        return $this->getUserByEmail($email);
    }

    public function insertUserController($fullname, $email, $username, $password)
    {
        return $this->insertUser($fullname, $email, $username, $password);
    }

    public function deleteUserController($id)
    {
        return $this->deleteUser($id);
    }

    public function updateUserController($userid, $fullname, $email, $password, $username, $userAcademic, $updateprofilestatus)
    {
        return $this->updateUser($userid, $fullname, $email, $password, $username, $userAcademic, $updateprofilestatus);
    }

    public function getUserByIdController($userid)
    {
        return $this->getUserById($userid);
    }

    public function updateUserOnlineStatusController($userid, $status)
    {
        return $this->updateUserOnlineStatus($userid, $status);
    }
}

?>