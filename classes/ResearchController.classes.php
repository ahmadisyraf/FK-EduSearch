<?php
class ResearchController extends Research {
    
    public function insertResearchController($adminid, $researchpapertitle, $researchrole, $researchstatus) {
        $newadmindid = intval($adminid);
        return $this->insertResearch($newadmindid, $researchpapertitle, $researchrole, $researchstatus);
    }

    public function getResearchController($adminid) {
        return $this->getResearch($adminid);
    }
}
?>