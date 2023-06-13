<?php
// Include the database connection
include "config/db.php";

$show_error;
$show_message;
$show_success;

// Check if the add publication form was submitted
if (isset($_POST['submit'])) {
    // Get the publication title and category from the form data
    $publicationTitle = $_REQUEST['publicationTitle'];
    $publicationCategory = $_REQUEST['publicationCategory'];

    $expert = new ExpertController();
    $result = $expert->insertExpertPublicationController($publicationTitle, $publicationCategory);

    if (!$result) {
        $show_error = true;
        $show_message = "Failed insert data";
    } else {
        $show_success = true;
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the publication list page
    header("Location: experteditpublication.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
