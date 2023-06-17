<?php

class ResearchArea extends Connection
{

    public function getResearchArea($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM researcharea WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if ($result) {
            return $result;
        } else {
            die("Error: " . mysqli_error($connection));
        }
    }

    public function updateResearchArea($userid, $research)
    {
        $connection = $this->getConnection();

        $query = "UPDATE researcharea SET researchTitle='$research' WHERE userid='$userid'";

        $result = mysqli_query($connection, $query);

        if ($result) {
            return $result;
        } else {
            die("Error: " . mysqli_error($connection));
        }
    }
}
?>