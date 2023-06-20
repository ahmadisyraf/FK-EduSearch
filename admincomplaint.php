<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="margin-top: 100px;">

    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php";

    $complaint = new ComplaintController();
    $user = new UserController();

    $user_data = json_decode($_COOKIE['user_data'], true);
    $userid = $user_data['uid'];

    $userid;
    $complaintDate;
    $complaintType;
    $complaintid;
    $complaintStatus;

    $complaint = $complaint->getAdminComplaint();

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 100px; padding-right: 100px">
        <h3 class="mt-5">Complaints</h3>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">All Complaint</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="container py-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ComplaintID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Complaint</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:20px"></th>
                                <th></th>
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
                            <td></td>
                            <td>
                            <div>
                            <a href="#" class="btn" style="color:white; background-color: #080202; width:100px">Delete</a>
                            <a href="complaintStatus.php?complaintid='.$row['complaintid'].'" class="btn" style="color:white; background-color: #080202; width:130px">Change Status</a>

                            </div>
                            </td>
                        </tr>
                                ';
                                    }
                                }
                            } ?>
                            <!-- // ?complaintid=' . $complaintid . ' -->
                        </tbody>
                    </table>
                    <a href="#" class="btn" style="color:white; background-color: #080202; width:200px">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>