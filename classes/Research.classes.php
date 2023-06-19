<?php

class Research extends Connection
{

    public function insertResearch($title, $role, $status, $userid)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO research VALUES (NULL, '$userid', '$title', '$role', '$status')";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getResearch($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM research WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateResearch($researchId, $title, $role, $status) {
        $connection = $this->getConnection();

        $query = "UPDATE research SET researchPaperTitle='$title', researchRole='$role', researchStatus='$status' WHERE researchid='$researchId'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deleteResearch($researchId) 
    {
        $connection = $this->getConnection();

        // Prepare the delete statement
        $deleteQuery = "DELETE FROM research WHERE researchid = ?";
        $deleteStatement = $connection->prepare($deleteQuery);
        $deleteStatement->bind_param("i", $researchId);

        // Execute the delete statement
        if ($deleteStatement->execute()) {

            // Check if any rows were affected
            if ($deleteStatement->affected_rows > 0) {
                // Update the researchid in real time
                $updateQuery = "SET @count = 0";
                $updateStatement = $connection->prepare($updateQuery);
                $updateStatement->execute();

                $updateQuery = "UPDATE research SET researchid = (@count:=@count+1) ORDER BY researchid";
                $updateStatement = $connection->prepare($updateQuery);
                $updateStatement->execute();

                return true; // Deletion successful
            }
        } 

        return false; // Deletion failed
    }
}
?>