<?php

class Complaint extends Connection
{
    public function getComplaint($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM complaint WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }
    public function getComplaintDetails($userid)
    {
        $connection = $this->getConnection();
    
        $query = "SELECT user.username, user.userEmail, complaint.complaintid, complaint.complaintDate, complaint.complaintType, complaint.complaintDescription, complaint.complaintStatus
                  FROM complaint
                  INNER JOIN user ON complaint.userid = user.userid
                  WHERE user.userid = '$userid'";
    
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getAdminComplaint()
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM complaint";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return $result;
        }
    }
    public function insertUserComplaint($uid,$postid, $complaintDate, $complaintType, $complaintDescription, $images)
    {
        $connection = $this->getConnection();
    
        $query = "INSERT INTO complaint VALUES (0,'$uid', '$postid', '$complaintDate', '$complaintType', '$complaintDescription', NULL,'$images')";
    
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
    



}
