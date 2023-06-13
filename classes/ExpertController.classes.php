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

    public function insertExpertController($fullname, $email, $username, $password) {
        return $this->insertExpert($fullname, $email, $username, $password);
    }

    public function deleteExpertController($id) {
        return $this->deleteExpert($id);
    }

    public function getPublication($id)
    {
        return $this->getPublication($id);
    }

    public function insertExpertPublicationController($publicationTitle, $publicationCategory)
    {
        return $this->insertExpertPublication($publicationTitle, $publicationCategory);
    }
}

?>