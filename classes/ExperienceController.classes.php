<?php
class ExperienceController extends Experience
{
    public function getAllUserExperienceController()
    {
        return $this->getAllUserExperience();
    }

    public function insertUserExperienceController($userid, $scale, $description, $recommend, $issueCategory, $issueDescription)
    {
        return $this->insertUserExperience($userid, $scale, $description, $recommend, $issueCategory, $issueDescription);
    }
}
?>