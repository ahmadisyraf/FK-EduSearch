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
    
    if (isset($_POST['addcomplaint'])) {
        $_COOKIE['user_data'];
        $user_cookie = json_decode($_COOKIE['user_data'], true);

        $userid = $user_cookie['userid'];
        $complaintDate = $_REQUEST['complaintDate'];
        $complaintType = $_REQUEST['complaintType'];
        $complaintDescription = $_REQUEST['complaintDescription'];

        $complaintController = new complaintController();
        $resultcomplaint = $complaintController->insertComplaintController($userid, $complaintDate, $complaintType, $complaintDescription);

        if (!$resultcomplaint) {
            $show_error = true;
            $show_message = "Failed to insert post data";
        } else {
            $show_success = true;
        }
    }
    ?>
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
                <form class="row g-1">
                    <div class="mb-3">
                    <label for="floatingInput">Email address</label>    
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        
                    </div>
                    <div class="">
                    <label for="floatingTextarea2">Description</label>
                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px"></textarea>
                        
                    </div>
                    <div class="col-md-">
                        <label for="inputState" class="form-label" >Complaint Type :</label>
                        <select id="inputState" style="padding-right:200px;" class="form-select">
                            <option selected>Choose one</option>
                            <option>Unsatisfied Experts Feedback</option>
                            <option>Wrongly Assigned Research Area</option>
                            <option>Other</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose image :</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <form>
                        <label for="example" class="form-label">Date & Time :</label>
                        <input style="width:150px" type="datetime-local" id="datetime" name="datetime">
                    
                    </form>
                    
                </form>
                <br>
                <a href="home.php" class="btn" style="color:white; background-color: #080202; width:100px">Back</a>
                <a href="#" class="btn" style="color:white; background-color: #080202; width:100px" name="addcomplaint">Submit</a>

</body>

</html>