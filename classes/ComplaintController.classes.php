
<?php

class ComplaintController extends Complaint
{

    //get complaint details for user display
    public function getComplaintDetailsController($userid)
    {
        return $this->getComplaintDetails($userid);
    }

    //get admin complaint for admin to display
    public function getAdminComplaintController($complaintid)
    {
        return $this->getComplaint($complaintid);
    }

    //inser complaint controller for user to insert their data
    public function insertComplaintController($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images)
    {
        return $this->insertUserComplaint($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images);
    }

    //update the status of complaint by admin
    public function updateComplaintController($complaintid, $uid, $postid, $complaintDate, $complaintType, $complaintDescription,$complaintStatus, $images)
    {
        return $this->updateComplaintStatus($complaintid, $uid);
    }

    //get all complaint for graph complaint
    public function getAllComplaintController($sort = '')
    {
        return $this->getAllUserComplaint($sort = '');
    }

    //delete controller for delete complaint
    public function deleteComplaintController($complaintid)
    {
        return $this->deleteComplaint($complaintid);
    }

    //search controller for search the complaint by the complaint type
    public function searchComplaintController($keyword, $complaintType) {
        return $this->searchComplaint($keyword, $complaintType);
    }

    //get all the complaint for the search by the complaint type
    public function getAllComplaintsController($complaintType) {

        return $this->getAllComplaint($complaintType);
    }

}

?>