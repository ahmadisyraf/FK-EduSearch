
<?php

class ComplaintController extends Complaint
{
    public function getComplaintDetailsController($userid)
    {
        return $this->getComplaintDetails($userid);
    }

    public function insertComplaintController($uid,$postid,$complaintDate, $complaintType, $complaintDescription, $images)
    {
        return $this->insertUserComplaint($uid,$postid,$complaintDate, $complaintType, $complaintDescription, $images);
    }
}

?>