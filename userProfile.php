<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php
    include "components/navigation.php";
    include "config/autoload.php";

    error_reporting(0);

    $user = new UserController();
    $researchArea = new ResearchAreaController();

    $user_data = json_decode($_COOKIE['user_data'], true);
    $email = $user_data['email'];
    $userid = $user_data['uid'];

    $fullname = NULL;
    $username = NULL;
    $academyStatus = NULL;
    $updatestatus = NULL;

    $researchTitle = NULL;

    $result = $user->getUserByEmail($email);
    $research = $researchArea->getResearchAreaController($userid);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fullname = $row['userFullName'];
                $username = $row['username'];
                $academyStatus = $row['userAcademicStatus'];
                $updatestatus = $row['userUpdateProfileStatus'];
            }
        }
    }

    if ($research) {
        if ($research->num_rows > 0) {
            while ($row = $research->fetch_assoc()) {
                $researchTitle = $row['researchTitle'];
            }
        }
    }

    if (isset($_POST['update'])) {
        $updateFullname = $_POST['fullname'];
        $updateEmail = $_POST['email'];
        $updateUsername = $_POST['username'];
        $updateAcademy = $_POST['academy'];
        $updateResearch = $_POST['research'];
        $update = $user->updateUserController($userid, $updateFullname, $updateEmail, NULL, $updateUsername, $updateAcademy, "Pending");
        $updatedResearch = $researchArea->updateResearchAreaController($userid, $updateResearch);
        $succes = false;
        $error = false;

        if ($update && $updatedResearch) {
            $succes = true;
        } else {
            $error = true;
        }
    }


    ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 300px; padding-right: 300px">
        <h3 class="my-3">Edit Profile</h3>
        <div class="animate__animated animate__zoomIn animate__faster">

        <div class="card text-left w-90">
            <div class="card-body">
                <?php
                if ($succes == true) {
                    echo '
                    <div class="alert alert-success" role="alert">
                        Update user profile succesfully please refresh this page
                    </div>
                    ';
                } else if ($error == true) {
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Failed to update user profile please contact our help center
                    </div>
                    ';
                } else if ($succes == false && $error == false) {
                    if($updatestatus == "Pending") {
                        echo '
                        <div class="alert alert-info" role="alert">
                            Your profile in progress to be accepted by admin.
                        </div>';
                    } else if ($updatestatus == "Rejected"){
                        echo '
                        <div class="alert alert-danger" role="alert">
                            Sorry, your profile has been rejected. Please contact admin
                        </div>';
                    }
                }
                ?>
                <form class="row g-3" action="" method="post">
                    <div class="col-md-12">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            class="rounded-circle" style="width: 150px;" alt="Avatar" />
                    </div>
                    <div class="col-md-12">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="fullname"
                            value="<?php echo $fullname ?>" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?> >
                    </div>
                    <div class="col-md-7">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="e.g: ali@gmail.com"
                            value="<?php echo $email ?>" name="email" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?> >
                    </div>
                    <div class="col-md-5">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="username" placeholder="e.g: ali"
                                aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $username ?>"
                                name="username" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?>>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="inputAcademic1" class="form-label">Area of Research</label>
                        <select class="form-select" id="inputState" name="research" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?>>
                            <option <?php echo $researchTitle ? NULL : "selected" ?> value="">Choose...</option>
                            <option <?php echo $researchTitle == "Software Engineering" ? "selected" : NULL ?>
                                value="Software Engineering">Software Engineering</option>
                            <option <?php echo $researchTitle == "Graphic and Multimedia" ? "selected" : NULL ?>
                                value="Graphic and Multimedia">Graphic and Multimedia</option>
                            <option <?php echo $researchTitle == "Networking" ? "selected" : NULL ?> value="Networking">
                                Networking</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-4">
                        <label for="inputSocialAcc" class="form-label">Social Account</label>
                        <input type="text" class="form-control" id="inputSocialAcc"
                            placeholder="e.g: https://twitter.com/ali">
                    </div> -->
                    <div class="col-md-12">
                        <label for="inputAcademic1" class="form-label">Current Acedamic Status</label>
                        <select class="form-select" id="inputState" required name="academy" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?>>
                            <option <?php echo $academyStatus ? NULL : "selected"; ?> value="">Choose...
                            </option>
                            <option value="Degree" <?php echo $academyStatus == "Degree" ? "selected" : NULL; ?>>Degree
                            </option>
                            <option value="Diploma" <?php echo $academyStatus == "Diploma" ? "selected" : NULL; ?>>Diploma
                            </option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-dark" name="update" style="width: 200px" <?php echo $updatestatus !== "Accepted"? "disabled" : null ?>>Update</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>

</html>