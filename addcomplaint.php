<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "config/autoload.php";

    $show_error = false;
    $show_message = "";
    $show_success = false;

    $_COOKIE['user_data'];

    $user_cookie = json_decode($_COOKIE['user_data'], true);

    if (isset($_POST['submit'])) {
        $uid = $user_cookie['uid'];
        // Retrieve the postid from the form or any other appropriate source
        $postid = $_REQUEST['postid']; // Update the form field name accordingly
        $complaintDate = $_REQUEST['complaintDate'];
        $complaintType = $_REQUEST['complaintType'];
        $complaintDescription = $_REQUEST['complaintDescription'];
        $images = $_REQUEST['images'];
        // Debugging statements
        var_dump($uid);
        var_dump($postid);
        var_dump($complaintDate);
        var_dump($complaintType);
        var_dump($complaintDescription);
        var_dump($images);

        $complaint = new Complaint();
        $result = $complaint->insertUserComplaint($uid, $postid, $complaintDate, $complaintType, $complaintDescription, $images);


        if (!$result) {
            $show_error = true;
            $show_message = "Failed to insert Complaint data";
        } else {
            $show_success = true;
            $show_message = "Your complaint has been submit.";
            header("Location: usercomplaint.php");
        }
    }
    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    ?>
    <?php include "components/navigation.php"; ?>
    <div class="px-5" style="margin-top:100px;">
        <h3 class="mt-5">Complaints</h3>
        <div class="card text-left" style="width:1000px;">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">Complaint Form</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="example" class="form-label">Date & Time :</label>
                        <input style="width:150px" type="datetime-local" id="complaintDate" name="complaintDate">
                    </div>
                    <br>
                    <div class="col-md-5">
                        <label for="inputState" class="form-label">Complaint Type :</label>
                        <select type="text" style="padding-right:200px;" class="form-select" name="complaintType" id="complaintType">
                            <option selected>Choose one</option>
                            <option value="Unsatisfied Experts Feedback">Unsatisfied Experts Feedback</option>
                            <option value="Wrongly Assigned Research Area">Wrongly Assigned Research Area</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="floatingTextarea2">Description</label>
                        <textarea class="form-control" type="text" id="floatingTextarea2" style="height: 100px" name="complaintDescription" id="complaintDescription"></textarea>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose image :</label>
                        <input class="form-control" type="file" id="images" name="images">
                    </div>
                    <br>
                    <?php include "components/navigation.php"; ?>
                    <button onclick="window.location.href='home.php'" class="btn" style="color:white; background-color: #080202; width:100px">Back</button>
                    <button onclick="window.location.href='usercomplaint.php'" type="submit" class="btn" style="color:white; background-color: #080202; width:100px" name="submit">Submit</button>

            </div>
            </form>
        </div>
    </div>
</body>

</html>