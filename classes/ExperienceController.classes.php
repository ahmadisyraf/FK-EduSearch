<?php
class ExperienceController extends Experience
{
    public function getAllUserExperienceController($role)
    {
        if ($role == "user") {
            return $this->getAllUserExperience();
        } else if ($role == "expert") {
            return $this->getAllExpertExperience();
        }
    }

    public function insertExperienceController($role, $userid, $scale, $description, $recommend, $issueCategory, $issueDescription)
    {
        if ($role == "user") {
            return $this->insertUserExperience($userid, $scale, $description, $recommend, $issueCategory, $issueDescription);
        } else if ($role == "expert") {
            return $this->insertExpertExperience($userid, $scale, $description, $recommend, $issueCategory, $issueDescription);
        }
    }

    public function countUserIssueController()
    {
        if ($this->countUserIssue()->num_rows > 0) {
            $result = $this->countUserIssue()->fetch_assoc();
            return $result['total'];
        }
    }

    public function countExpertIssueController()
    {
        if ($this->countUserIssue()->num_rows > 0) {
            $result = $this->countExpertIssue()->fetch_assoc();
            return $result['total'];
        }
    }

    public function getUserBugIssueController($category, $type)
    {
        if ($type == "user") {
            return $this->getUserBugIssue($category);
        } else if ($type == "expert") {
            return $this->getExpertBugIssue($category);
        } else {
            return NULL;
        }
    }

    public function getUserDataController($category, $role)
    {
        if ($role == "user" && $category !== "All") {
            return $this->getUserData($category);
        } else if ($role == "expert" && $category !== "All") {
            return $this->getExpertData($category);
        } else if ($role == "user" && $category == "All") {
            return $this->getAllUserData();
        } else if ($role == "expert" && $category == "All") {
            return $this->getAllExpertData();
        }
    }
}
?>