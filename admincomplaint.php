<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="margin-top: 10px;">


    
    <?php
    error_reporting(0);
    ini_set('display_errors', 0);
    include "components/navigation.php";
    include "config/autoload.php";

    $complaint = new ComplaintController();
    $user = new UserController();

    $user_data = json_decode($_COOKIE['user_data'], true);
    $userid = $user_data['uid'];

    $userid;
    $complaintDate;
    $complaintType;
    $complaintid;
    $complaintStatus;

    $complaintAdmin = $complaint->getAdminComplaint();

    if (isset($_POST['deletecomplaint'])) {
        $delete = $complaint->deleteComplaint($_POST['complaintid']);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    $searchComplaint = new ComplaintController(); // Instantiate the class
    $result;

    $result = $searchComplaint->getAllComplaint($complaintType);



    if (isset($_POST['submitsearch'])) {
        $keyword = $_REQUEST['search_keyword'];
         // Retrieve the complaint type value
         $complaintType = $_POST['complaintType'];
        $result = $searchComplaint->searchComplaint($keyword, $complaintType); // Pass both keyword and complaint type to the search function
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>




    
    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 100px; padding-right: 100px">
        <div style="width: 50%; margin-left:25%;">
            <form action="" method="post" class="hstack gap-2" style="margin-top: 10px">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search Complaint" name="search_keyword">
                
                <button type="submit" class="btn btn-dark" name="submitsearch" style="width: 105px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    Search
                </button>
                </form>
        </div>
        
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
                            if ($result) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
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
                                ' . $complaintStatus . '

                        </td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <form method="POST">
                                    <input type="hidden" name="complaintid" value="' . $complaintid . '">
                                    <button style="margin-right:20px;" type="submit" name="deletecomplaint" class="btn btn-dark">Delete</button>
                                
                                <a href="complaintStatus.php?complaintid=' . $complaintid . '" class="btn btn-outline-dark">Change Status</a>
                                </form>
                                </div>
                        </td>
                    </tr>
                ';
                                    }
                                }
                            } else {
                                echo '<tr><td colspan="7">No complaints found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="home.php" class="btn" style="color:white; background-color: #080202; width:200px">Back</a>
                    <a href="complaintReport.php" class="btn" style="color:white; background-color: #080202; width:200px">Complaint Report</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>