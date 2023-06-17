<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
            text-align: left;
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

<body>
    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 100px; padding-right: 100px">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <?php
        include "config/autoload.php";

        $complaint = new ComplaintController();
        $user = new UserController();

        $user_data = json_decode($_COOKIE['user_data'], true);
        $userid = $user_data['uid'];

        $userid;
        $complaintDate;
        $complaintType;
        $complaintid;

        $complaint = $complaint->getComplaintController($userid);




        ?>


        <h3 class="mt-5"><img style="width:150px; height:150px" src="public/undraw_Things_to_say_re_jpcg.png" height="30"> My Complaints</h3>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#"><i class="fas fa-list"></i> All Complaints</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ComplaintID</th>
                            <th style="width:10px;">User ID</th>
                            <th>Complaint</th>
                            <th>Date</th>
                            <th style="width:20px">Status</th>
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
                                    echo '
                        <tr>
                            <th scope="row" style="width:40px">'.$complaintid.'</th>
                            <td style="width:10px;">'.$userid.'</td>
                            <td>'.$complaintType.'</td>
                            <td>'.$complaintDate.'</td>
                            <td>
                                <div class="alert alert-primary" role="alert">
                                    In-Investigation
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button style="color:black;" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="complaintdetails.php?userid=' . $userid . '">View</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                                ';
                                }
                            }
                        } ?>
                        
                    </tbody>
                </table>
                <a href="#" class="btn-back">Back</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>