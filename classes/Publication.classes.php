<?php

class Publication extends Connection
{

    public function insertPublication($title, $date, $category, $userid)
    {
        $connection = $this->getConnection();

        $query = "INSERT INTO publication VALUES (NULL, '$userid', '$title', '$date', '$category' )";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function getPublication($userid)
    {
        $connection = $this->getConnection();

        $query = "SELECT * FROM publication WHERE expertid='$userid'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updatePublication($publicationId, $title, $category) {
        $connection = $this->getConnection();

        $query = "UPDATE publication SET publicationTitle='$title', publicationCategory='$category' WHERE publicationid='$publicationId'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function deletePublication($publicationId)
{
    $connection = $this->getConnection();

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM publication WHERE publicationid = ?";
    $deleteStatement = $connection->prepare($deleteQuery);
    $deleteStatement->bind_param("i", $publicationId);

    // Execute the delete statement
    if ($deleteStatement->execute()) {
        // Check if any rows were affected
        if ($deleteStatement->affected_rows > 0) {
            // Update the publicationid in real time
            $updateQuery = "SET @count = 0";
            $updateStatement = $connection->prepare($updateQuery);
            $updateStatement->execute();

            $updateQuery = "UPDATE publication SET publicationid = (@count:=@count+1) ORDER BY publicationid";
            $updateStatement = $connection->prepare($updateQuery);
            $updateStatement->execute();

            return true; // Deletion successful
        }
    }

    return false; // Deletion failed
}



}

?>