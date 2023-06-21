<?php
class ExpertController extends Expert
{
    public function getExpertController($email, $password)
    {
        return $this->getExpert($email, $password);
    }

    public function getAllExpertController()
    {
        return $this->getAllExpert();
    }

    public function getExpertByEmailController($email)
    {
        return $this->getExpertByEmail($email);
    }

    public function insertExpertController($fullname, $email, $password, $username, $status)
    {
        return $this->insertExpert($fullname, $email, $password, $username, $status);
    }

    public function updateExpertController($fullname, $username, $academicstatus, $updateprofilestatus, $accountstatus, $expertid)
    {
        return $this->updateExpert($fullname, $username, $academicstatus, $updateprofilestatus, $accountstatus, $expertid);
    }

    public function updateExpertOnlineStatusController($userid, $status)
    {
        return $this->updateExpertOnlineStatus($userid, $status);
    }

    public function updateExpertLastLoginController($userid, $lastlogin)
    {
        return $this->updateExpertLastLogin($userid, $lastlogin);
    }

    public function insertExpertLastLoginController($userid, $lastlogin)
    {
        return $this->insertExpertLastLogin($userid, $lastlogin);
    }

    public function getExpertByIdController($userid)
    {
        return $this->getExpertById($userid);
    }

    public function getExpertLastLoginController($userid)
    {
        return $this->getExpertLastLogin($userid);
    }

    public function getExpertAccountStatusController($userid)
    {
        return $this->getExpertAccountStatus($userid);
    }

    public function updateExpertAccountStatusController($userid, $status)
    {
        $update_last_login = $this->updateExpertLastLoginController($userid, date("Y-m-d H:i:s"));

        if ($update_last_login) {
            return $this->updateExpertAccountStatus($userid, $status);
        }
    }

    public function getTotalExpertController()
    {
        return $this->getTotalExpert();
    }

    public function searchExpertController($keyword)
    {
        return $this->searchExpert($keyword);
    }
}

?>