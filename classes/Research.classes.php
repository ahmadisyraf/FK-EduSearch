<?php

class Research extends Connection
{

    public function insertResearch($adminid, $researchpapertitle, $researchrole, $researchstatus)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO research VALUES (NULL, '$adminid', '$researchpapertitle', '$researchrole', '$researchstatus')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }

    }

    public function getResearch($adminid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM research WHERE adminid='$adminid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }
}
?>