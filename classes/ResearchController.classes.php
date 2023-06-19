<?php
class ResearchController extends Research {
    
    public function insertResearchController($title, $role, $status, $userid) {
        return $this->insertResearch($title, $role, $status, $userid);
    }

    public function getResearchController($userid) {
        return $this->getResearch($userid);
    }

    public function updateResearchController($researchId, $title, $role, $status) {
        return $this->updateResearch($researchId, $title, $role, $status);
    }

    public function deleteResearchController($researchId) {
        return $this->deleteResearch($researchId);
    }
}
?>