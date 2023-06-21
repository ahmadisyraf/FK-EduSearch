<?php
session_start();
?>

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

    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php" ?>

    <?php
    $fullname;
    $username;
    $email;
    $academic;
    $profileupdatestatus;

    $expert = new ExpertController();

    $userdata = json_decode($_COOKIE['user_data'], true);
    $cookie_email = $userdata['email'];
    $cookie_userid = $userdata['uid'];
    $expertId = $cookie_userid; // Use the expert ID stored in the $cookie_userid variable
    $db_data = $expert->getExpertByIdController($expertId); // Retrieve expert data by ID


    if ($db_data) {
        if ($db_data->num_rows > 0) {
            while ($row = $db_data->fetch_assoc()) {
                $fullname = $row['expertFullName'];
                $username = $row['expertUsername'];
                $email = $row['expertEmail'];
                $academic = $row['researchAcademicStatus'];
                $profileupdatestatus = $row['expertUpdateProfileStatus'];
            }
        }
    }

    $success = false;
    $error = false;

    if (isset($_POST['update'])) {
        $updatefullname = $_POST['fullname'];
        $updateusername = $_POST['username'];
        $updateemail = $_POST['email'];
        $updateacademic = $_POST['academic'];

        $updated = $expert->updateExpertController($updatefullname, $updateusername, $updateacademic, "Pending", "", $cookie_userid);

        if ($updated) {
            $success = true;
            echo '<script>
                    
                      setTimeout(function() {
                          window.location.href = "experteditprofile.php";
                      }, 2000); // Redirect after 2 seconds
                  </script>';
        } else {
            $error = true;
        }
    }

    ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Expert Profile</h3>
        <?php
        if ($success == true) {
            echo '
            <div class="alert alert-success" role="alert">
                Yeayy! your profile has been updated! Page refreshing in 2 seconds.
            </div>
            ';
        } else if ($error == true) {
            echo '
            <div class="alert alert-danger" role="alert">
                Oops! Failed to update your profile. Please try again.
            </div>
            ';
        } 
        ?>
        <div class="card text-left w-90 animate__animated animate__zoomIn">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="experteditresearch.php">Research</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="experteditpublication.php">Publication</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form class="row g-3" action="" method="post">
                    <div class="col-md-12">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                            style="width: 200px;" alt="Avatar" />
                    </div>
                    <div class="col-md-8">
                        <label for="firstname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" id="firstname" value="<?php echo $fullname ?>"
                            name="fullname" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" id="username" placeholder="e.g: ali"
                                aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $username ?>"
                                name="username" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="e.g: ali@gmail.com"
                            value="<?php echo $email ?>" name="email" readonly>
                    </div>
                    <div class="col-md-8">
                        <label for="inputAcademic1" class="form-label">Academic</label>
                        <input type="text" class="form-control" id="inputAcademic1"
                            placeholder="e.g: Computer Science (2005 - 2014), Universiti Teknologi Malaysia, Skudai"
                            name="academic" value="<?php echo $academic ? $academic : '' ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#editModal">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editFullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" id="editFullname" name="fullname"
                            value="<?php echo $fullname ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username"
                            value="<?php echo $username ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email"
                            value="<?php echo $email ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editAcademic" class="form-label">Academic</label>
                        <input type="text" class="form-control" id="editAcademic" name="academic"
                            value="<?php echo $academic ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
