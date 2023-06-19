
<?php

class ComplaintController extends Complaint
{
    // public function ge($email, $password) {
    //     return $this->getExpert($email, $password);
    // }

    // public function getAllExpertController() {
    //     return $this->getAllExpert();
    // }

    public function getComplaintController($userid)
    {
        return $this->getComplaint($userid);
    }


    public function getComplaintDetailsController($userid)
    {
        return $this->getComplaintDetails($userid);
    }

    public function insertComplaintController($userid, $postid, $complaintDate, $complaintType, $complaintDescription, $images)
    {
        return $this->insertUserComplaint($userid, $postid, $complaintDate, $complaintType, $complaintDescription, $images);
    }
    // public function insertComplantController($complaintid, $userid, $complaintDate, $complaintType, $complaintDescription,$complaintStatus) {
    //     return $this->insertComplaint($complaintid, $userid, $complaintDate, $complaintType, $complaintDescription,$complaintStatus);
    // }

    // public function updateExpertController($fullname, $username, $academicstatus, $updateprofilestatus, $accountstatus, $expertid) {
    //     return $this->updateExpert($fullname, $username, $academicstatus, $updateprofilestatus, $accountstatus, $expertid);
    // }
}

?>