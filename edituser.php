<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php
    include "config/autoload.php";

    session_start();

    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }

    $userid = $_REQUEST['userid'];
    $type = $_REQUEST['type'];

    $user = new UserController();
    $expert = new ExpertController();

    $db_fullname;
    $db_email;
    $db_username;
    $db_password;
    $db_profilestatus;
    $db_accountstatus;

    if($type == "user") {
        $db_user = $user->getUserById($userid);

        if ($db_user && $db_user->num_rows > 0) {
            while ($row = $db_user->fetch_assoc()) {
                $db_fullname = $row['userFullName'];
                $db_email = $row['userEmail'];
                $db_username = $row['username'];
                $db_password = $row['userPassword'];
                $db_profilestatus = $row['userUpdateProfileStatus'];
            }
        }
    } 
    else if ($type == "expert") {
        $db_expert = $expert->getExpertByIdController($userid);

        if ($db_expert && $db_expert->num_rows > 0) {
            while ($row = $db_expert->fetch_assoc()) {
                $db_fullname = $row['expertFullName'];
                $db_email = $row['expertEmail'];
                $db_username = $row['expertUsername'];
                $db_password = $row['expertPassword'];
                $db_profilestatus = $row['expertUpdateProfileStatus'];
                $db_accountstatus = $row['expertAccountStatus'];
            }
        }
    }

    $show_success = false;
    $show_error = false;

    if (isset($_POST['submit'])) {
        if ($type == "user") {
            $update_fullname = $_POST['fullname'];
            $update_email = $_POST['email'];
            $update_username = $_POST['username'];
            $update_password = $_POST['password'];
            $update_profilestatus = $_POST['profilestatus'];
            $update_user = $user->updateUser($userid, $update_fullname, $update_email, $update_password, $update_username, NULL, $update_profilestatus);
            if ($update_user) {
                $show_success = true;
            } else {
                $show_error = true;
            }
        } else if ($type == "expert") {
            $update_fullname = $_POST['fullname'];
            $update_email = $_POST['email'];
            $update_username = $_POST['username'];
            $update_password = $_POST['password'];
            $update_profilestatus = $_POST['profilestatus'];
            $update_accountstatus = $_POST['accountstatus'];
            $update_expert = $expert->updateExpertController($update_fullname, $update_username, "", $update_profilestatus, "", $userid);
            $updated_accountstatus = $expert->updateExpertAccountStatusController($userid, $update_accountstatus);
            
            if($update_expert && $updated_accountstatus) {
                $show_success = true;
            } else {
                $show_error = true;
            }
        }
    }

    ?>

    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center"
        style="padding-left: 400px; padding-right: 400px; margin-top: 150px">
        <form action="" method="post">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="users.php">Manage User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
                <h3 class="my-4">Update user information</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="#">Enter you details</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <?php
                        if ($show_error == true) {
                            echo '
                            <div class="alert alert-danger w-100" role="alert">
                                Opps! there an error. Please try again
                            </div>';
                        } else if ($show_success == true) {
                            echo '
                            <div class="alert alert-success w-100" role="alert">
                                Yeay! user data successfuly updated!
                            </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Full name</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                            name="fullname" value="<?php echo $db_fullname; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input type="email" class="form-control" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" name="email" value="<?php echo $db_email; ?>">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Username</span>
                        <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon2"
                            name="username" value="<?php echo $db_username; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input type="password" class="form-control" aria-label="" aria-describedby="basic-addon2"
                            name="password" value="<?php echo $db_password; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Profile status</label>
                        <select class="form-select" id="inputGroupSelect01" name="profilestatus">
                            <option value="Accepted" <?php echo $db_profilestatus === "Accepted" ? "selected" : NULL ?>>
                                Accepted</option>
                            <option value="Pending" <?php echo $db_profilestatus === "Pending" ? "selected" : NULL ?>>
                                Pending</option>
                            <option value="Rejected" <?php echo $db_profilestatus === "Rejected" ? "selected" : NULL ?>>
                                Rejected</option>
                        </select>
                    </div>

 
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Account Status</label>
                        <select class="form-select" id="inputGroupSelect01" name="accountstatus" <?php echo $type == "user"? "disabled" : NULL; ?> >
                            <option value="Active" <?php echo $db_accountstatus === "Active" ? "selected" : NULL ?>>
                                Active</option>
                            <option value="Deactive" <?php echo $db_accountstatus === "Deactive" ? "selected" : NULL ?>>
                                Deactive</option>
                        </select>
                    </div>
                    <br>
                    <div class="w-100">
                        <button type="submit" class="btn btn-dark w-100" name="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>