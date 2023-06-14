<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FK-EduSearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php session_start() ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <?php
    include "config/autoload.php";

    $show_error = false;
    $show_message = "";
    $_SESSION['logged_out'];
    $_SESSION['role'];

    if ($_SESSION['logged_out'] == false) {
        header("Location: home.php");
    } else if ($_SESSION['logged_out'] == true) {
        if (isset($_POST['Login'])) {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $role = $_REQUEST['userrole'];

            if (!$email || !$password) {
                $show_message = true;
                $show_message = "Please field all field";
            }

            if ($role == "admin") {
                $admin_login = new AdminController();

                $result = $admin_login->getAdminController($email, $password);

                if ($result == false) {
                    $show_error = true;
                    $show_message = "Wrong email or password";
                } else {

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $userArray = array(
                                'uid' => $row['adminid'],
                                'fullname' => $row['adminFullName'],
                                'email' => $row['adminEmail'],
                                'login' => true
                            );

                            setcookie("user_data", json_encode($userArray));
                        }
                    }

                    $_SESSION["logged_out"] = false;
                    $_SESSION["role"] = "admin";
                    header("Location: home.php");
                    exit();
                }

            } else if ($role == "user") {
                $user_login = new UserController();

                $result = $user_login->getUserController($email, $password);

                if ($result == false) {
                    $show_error = true;
                    $show_message = "Wrong email or password";
                } else {

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $userArray = array(
                                'uid' => $row['userid'],
                                'fullname' => $row['userFullName'],
                                'email' => $row['userEmail'],
                                'login' => true,
                            );

                            setcookie("user_data", json_encode($userArray));
                        }
                    }

                    $_SESSION["logged_out"] = false;
                    $_SESSION["role"] = "user";
                    header("Location: home.php");

                }
            } else if ($role == "expert") {
                $expert_login = new ExpertController();

                $result = $expert_login->getExpertController($email, $password);

                if ($result == false) {
                    $show_error = true;
                    $show_message = "Wrong email or password";
                } else {

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $userArray = array(
                                'uid' => $row['expertid'],
                                'fullname' => $row['expertFullName'],
                                'email' => $row['expertEmail'],
                                'login' => true,
                            );

                            setcookie("user_data", json_encode($userArray));
                        }
                    }

                    $_SESSION["logged_out"] = false;
                    $_SESSION["role"] = "expert";
                    header("Location: home.php");

                }
            }
        }
    }
    ?>

    <?php include "components/navigation.php" ?>
    <div class="animate__animated animate__zoomIn animate__faster">
    <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card px-5 w-50">
                <div class="card-body">
                    <div class="mt-3">
                        <img src="public/mini-logo.png" width="40" alt="...">
                    </div>
                    <div class="mt-3 mb-4">
                        <h3>Login to FK-EduSearch</h3>
                    </div>
                    <form action="" method="post">
                        <?php
                        if ($show_error == true) {
                            echo '
                           <div class="my-3 alert alert-danger" role="alert">'
                                . $show_message .
                                '</div>
                           ';
                        }

                        ;
                        ?>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="name@example.com" name="email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="**********" name="password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" aria-label="Default select example" name="userrole">
                                <option selected value="">Choose role</option>
                                <option value="user">User</option>
                                <option value="expert">Expert</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-link">Forgot password?</button>
                        </div>
                        <div class="my-3">
                            <input type="submit" value="Login" name="Login" class="btn btn-dark w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>