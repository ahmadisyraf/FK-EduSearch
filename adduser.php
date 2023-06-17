<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    $show_error;
    $show_message;
    $show_success;

    if (isset($_POST['submit'])) {
        $fullname = $_REQUEST['fullname'];
        $email = $_REQUEST['email'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $role = $_REQUEST['role'];

        if (!$fullname || !$email || !$username || !$password || !$role) {
            $show_error = true;
            $show_message = "Please fill all fields";
        }

        if ($role == "user") {
            $user = new UserController();
            $result = $user->insertUserController($fullname, $email, $username, $password);

            if (!$result) {
                $show_error = true;
                $show_message = "Failed insert user data";
            } else {
                $show_success = true;
            }
        } else if ($role == "admin") {
            $admin = new AdminController();
            $result = $admin->insertAdmin($fullname, $email, $username, $password);
    
            if (!$result) {
                $show_error = true;
                $show_message = "Failed insert user data";
            } else {
                $show_success = true;
            }
        } else if ($role == "expert") {
            $expert = new ExpertController();

            $result = $expert->insertExpertController($fullname, $email, $password, $username, "Active");

            if ($result) {
                $show_error = true;
                $show_message = "Failed insert user data";
            } else {
                $show_success = true;
            }
        }

        header("refresh:3;url=users.php");
    }

    ?>

    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100"
        style="padding-left: 400px; padding-right: 400px">
        <form action="" method="post">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Manage User</li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
                <h3 class="my-4">Add New User/Expert/Admin</h3>
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
                            <div class="alert alert-danger w-100" role="alert">'
                                . $show_message .
                                '</div>';
                        } else if ($show_success == true) {
                            echo '
                            <div class="alert alert-success w-100" role="alert">
                                Succesfully insert user (Redirect to manage user page in 3 seconds)
                            </div>';
                        }
                        ?>
                    </div>
                    <div class="mb-3 text-center">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center position-relative">
                                <div class="me-3">
                                    <img id="profileImagePreview" class="rounded-circle w-25 h-25" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Blank Profile Picture">
                                    <button type="button" class="btn btn-sm btn-transparent btn-image position-absolute bottom-0 start-50 ms-5" id="uploadImage" data-bs-toggle="modal" data-bs-target="#imageModal">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Upload Profile Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Upload your profile image here.</p>
                                    <input class="form-control form-control-sm" type="file" id="formFile" name="image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Full name</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                            name="fullname">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Email</span>
                        <input type="email" class="form-control" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" name="email">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Username</span>
                        <input type="text" class="form-control" aria-label="" aria-describedby="basic-addon2"
                            name="username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input type="password" class="form-control" aria-label="" aria-describedby="basic-addon2"
                            name="password">
                    </div>

                    <select class="form-select" aria-label="Default select example" name="role">
                        <option selected value="">Select Role :</option>
                        <option value="user">User</option>
                        <option value="expert">Expert</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br>
                    <div class="w-100">
                        <button type="submit" class="btn btn-dark w-100" name="submit">Add User</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>