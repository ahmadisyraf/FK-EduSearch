<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        body {
            
            background-color: #f8f9fa;
            color: #343a40;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
        }

        .nav-link {
            color: #fff;
        }

        .card-body {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
        }

        .btn-back {
            color: #fff;
            background-color: #080202;
            width: 100px;
            text-align: center;
            display: block;
            margin: 20px auto;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
        }

        .alert-primary {
            background-color: #007bff;
            color: #fff;
        }

        .alert-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>

<body style="margin-top:100px;">
    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php";

    error_reporting(0);
    ini_set('display_errors', 0);

    $complaint = new ComplaintController();
    $user = new UserController();

    $user_data = json_decode($_COOKIE['user_data'], true);
    $userid = $user_data['uid'];

    $userid;
    $complaintDate;
    $complaintType;
    $complaintid;
    $complaintStatus;

    $complaint = $complaint->getComplaint($userid);
    ?>

    <?php 
    include "components/navigation.php";

    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    ?>

    <div class="container py-4">
        <div class="breadcrumbs" style="margin-bottom: 10px;">
            <form action="" method="post" class="hstack gap-2">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="addcomplaint.php">Add Complaint</a></li>
                        <li class="breadcrumb-item"><a href="usercomplaint.php">Your Complaint</a></li>
                    </ol>
                </nav>
        </div>
        <h3 class="mt-5 animate__animated animate__fadeInUp"><img style="width:150px; height:150px" src="public/undraw_Things_to_say_re_jpcg.png" height="30"> My Complaints</h3>
        <div class="card text-center animate__animated animate__fadeInUp">
            <div class="card-header animate__animated animate__fadeInUp">
                <ul class="nav nav-tabs card-header-tabs animate__animated animate__fadeInUp">
                    <li class="nav-item animate__animated animate__fadeInUp">
                        <a class="nav-link active animate__animated animate__fadeInUp" aria-current="true" href="#"><i class="fas fa-list"></i> All Complaints</a>
                    </li>
                </ul>
            </div>
            <div class="card-body animate__animated animate__fadeInUp">
                <table class="table animate__animated animate__fadeInUp">
                    <thead>
                        <tr>
                            <th style="width:200px;">ComplaintID</th>
                            <th style="width:200px;">User ID</th>
                            <th>Complaint</th>
                            <th>Date</th>
                            <th style="width:180px">Status</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($complaint) {
                            if ($complaint->num_rows > 0) {
                                while ($row = $complaint->fetch_assoc()) {
                                    $complaintid = $row['complaintid'];
                                    $userid = $row['userid'];
                                    $complaintDate = $row['complaintDate'];
                                    $complaintType = $row['complaintType'];
                                    $complaintStatus = $row['complaintStatus'];
                                    echo '
                        <tr>
                            <th>' . $complaintid . '</th>
                            <td>' . $userid . '</td>
                            <td>' . $complaintType . '</td>
                            <td>' . $complaintDate . '</td>
                            <td>
                                <div class="alert" role="alert">
                                    ' . $complaintStatus . '
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button style="color:black;" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="complaintdetails.php?userid=' . $userid . '?complaintid=' . $complaintid . '">View</a></li>
                                    </ul>
                                    
                                </div>
                            </td>
                        </tr>
                                ';
                                }
                            }
                        } 
                    ?>
                    </tbody>
                </table>
                <a href="home.php" class="btn-back">Back</a>
            </div>
        </div>
    </div>
</body>

</html>