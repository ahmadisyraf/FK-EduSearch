<?php
class ResearchAreaController extends ResearchArea
{
    public function getResearchAreaController($userid)
    {
        return $this->getResearchArea($userid);
    }

    public function updateResearchAreaController($userid, $research)
    {
        return $this->updateResearchArea($userid, $research);
    }
}
?>