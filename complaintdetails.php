<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>

<body style="margin-top:100px;">

    
    <?php include "components/navigation.php"; ?>

    <?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
    include 'config/autoload.php';

    $complaint = new ComplaintController();
    $userid = $_GET['userid'];
    $complaintid = $_GET['complaintid'];
    $complaintDetails = $complaint->getComplaintDetails($userid);

    if ($complaintDetails->num_rows > 0) {

        $row = mysqli_fetch_assoc($complaintDetails);
        $username = $row['username'];
        $userEmail = $row['userEmail'];
        $complaintid = $row['complaintid'];
        $complaintDate = $row['complaintDate'];
        $complaintType = $row['complaintType'];
        $complaintDescription = $row['complaintDescription'];
        $complaintStatus = $row['complaintStatus'];
        $images = $row['images'];

    } else {

        echo "Failed to retrieve complaint details.";
        // It might be a good idea to define default values for the variables here if necessary.
    }
    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {

        header("Location: index.php");
    }
    ?>


    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 100px; padding-right: 100px">
        <div class="breadcrumbs" style="margin-bottom: 10px;">
            <form action="" method="post" class="hstack gap-2">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="addcomplaint.php">Add Complaint</a></li>
                        <li class="breadcrumb-item"><a href="usercomplaint.php">Your Complaint</a></li>
                        <li class="breadcrumb-item"><a href="complaintdetails.php">Complaint Details</a></li>
                    </ol>
                </nav>
        </div>
        <h3 class="mt-5 animate__animated animate__fadeInUp"><img style="width:90px; height:80px" src="../FK-EduSearch/public/undraw_attached_file_re_0n9b.png" height="30"> My Complaints</h3>
        <div class="card text-center w-50 animate__animated animate__fadeInUp">
            <div class="card-header animate__animated animate__fadeInUp">
                <ul class="nav nav-tabs card-header-tabs animate__animated animate__fadeInUp">
                    <li class="nav-item animate__animated animate__fadeInUp">
                        <a class="nav-link active animate__animated animate__fadeInUp" aria-current="true" href="#">Complaint ID : <?php echo $complaintid ?></a>
                    </li>
                </ul>
            </div>
            <div class="card-body animate__animated animate__fadeInUp">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $username; ?>" readonly>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo $userEmail; ?>" readonly>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Date & Time</span>
                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon2" value="<?php echo $complaintDate; ?>" readonly>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Complaint Type</span>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $complaintType; ?>" readonly>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Status</span>
                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon2" value="<?php echo $complaintStatus; ?>" readonly>
                </div>

                <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" aria-label="With textarea" readonly><?php echo $complaintDescription; ?></textarea>
                </div>

                <br>
                <div class="input-group mb-3">
                    <span class="input-group-text">Images</span>
                    <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon2" value="<?php echo $images; ?>" readonly>
                </div>  

                <a href="usercomplaint.php" style="color:white; background-color: #080202; width:100px" class="btn">Back</a>
            </div>
        </div>
    </div>
</body>

</html>