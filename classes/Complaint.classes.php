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

        $query = "SELECT user.username, user.userEmail, complaint.complaintid, complaint.complaintDate, complaint.complaintType, complaint.complaintDescription, complaint.complaintStatus, complaint.images
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
    public function insertUserComplaint($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images)
    {
        $connection = $this->getConnection();
        $status = "In Investigation"; // Set the default status here

        $query = "INSERT INTO complaint VALUES (0,'$uid', '$postid', '$complaintDate', '$complaintType', '$complaintDescription', '$status', '$images')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
    public function updateComplaintStatus($complaintid,$complaintStatus)
    {
        $connection = $this->getConnection();
        $query = "UPDATE complaint SET complaintStatus='$complaintStatus' WHERE complaintid='$complaintid'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return true;
        }
    }

    public function getAllUserComplaint($sort = '')
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM complaint";

        if ($sort == 'day') {
            $query .= " ORDER BY complaintDate DESC";
        } elseif ($sort == 'week') {
            $query .= " ORDER BY YEARWEEK(complaintDate) DESC";
        } elseif ($sort == 'year') {
            $query .= " ORDER BY YEAR(complaintDate) DESC";
        }

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
    public function getAdminComplaintDetails($complaintid)
    {
        $connection = $this->getConnection();

        $query = "SELECT user.username, user.userEmail, complaint.complaintid, complaint.complaintDate, complaint.complaintType, complaint.complaintDescription, complaint.complaintStatus, complaint.images
                  FROM complaint
                  INNER JOIN user ON complaint.userid = user.userid
                  WHERE complaint.complaintid = '$complaintid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}
