
<?php

class ComplaintController extends Complaint
{
    public function getComplaintDetailsController($userid)
    {
        return $this->getComplaintDetails($userid);
    }
    public function getAdminComplaintController($complaintid)
    {
        return $this->getComplaint($complaintid);
    }

    public function insertComplaintController($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images)
    {
        return $this->insertUserComplaint($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images);
    }

    public function updateComplaintController($complaintid, $uid, $postid, $complaintDate, $complaintType, $complaintDescription,$complaintStatus, $images)
    {
        return $this->updateComplaintStatus($complaintid, $uid, $postid, $complaintDate, $complaintType, $complaintDescription,$complaintStatus, $images);
    }

    public function getAllComplaintController($sort = '')
    {
        return $this->getAllUserComplaint($sort = '');
    }



}

?>