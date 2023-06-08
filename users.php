<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php

    session_start();

    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    ?>

    <?php include "components/navigation.php"; ?>
    <?php include "components/sidebar.php" ?>

    <?php
    include "config/autoload.php";

    $result;
    $click_user = true;
    $click_admin = false;
    $click_expert = false;
    $user = new UserController();
    $admin = new AdminController();
    $expert = new ExpertController();

    if (isset($_POST['deleteuser'])) {
        $delete = $user->deleteUser($_POST['userid']);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_POST['admin'])) {
        $result = $admin->getAllAdmin();

        $click_user = false;
        $click_expert = false;
        $click_admin = true;
    } else if (isset($_POST['expert'])) {

        $result = $expert->getAllExpert();
        $click_user = false;
        $click_expert = true;
        $click_admin = false;

    } else {
        $result = $user->getAllUserController();
    }

    ?>

    <div class="d-flex justify-content-center hv-100">
        <div>
            <div class="d-flex justify-content-between" style="margin-top: 200px; margin-bottom: 30px; width: 100%">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                        </ol>
                    </nav>
                    <h4>Manage User</h4>
                </div>
                <div class="pt-5">
                    <a type="submit" class="btn btn-dark" href="adduser.php">Add User</a>
                </div>
            </div>
            <div class="card" style="">
                <div class="card-body px-5">
                    <div class="mt-3 d-flex justify-content-between">
                        <h5>User List</h5>
                        <form action="" method="post">
                            <div class="nav nav-pills">
                                <div class="nav-item">
                                    <button type="submit"
                                        class="<?php echo ($click_user ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="user">User</button>
                                </div>
                                <div class="nav-item">
                                    <button type="submit"
                                        class="<?php echo ($click_expert ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="expert">Expert</button>
                                </div>
                                <div class="nav-item">
                                    <button type="submit"
                                        class="<?php echo ($click_admin ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="admin">Admin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form action="" method="post">
                        <table class="table mt-5" style="width: 800px">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <?php echo isset($_POST['expert'])? '<th scope="col">Status</th>' : NULL ?>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['admin'])) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $adminId = $row['adminid'];
                                            echo '
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>' . $row['adminFullName'] . '</td>
                                            <td>' . $row['adminEmail'] . '</td>
                                            <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                            <td><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal' . $adminId . '">Delete</button></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal' . $adminId . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $adminId . '" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel' . $adminId . '">Delete user account</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you confirm to delete ' . $row['adminFullName'] . ' account? 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                        }
                                    }
                                } else if (isset($_POST['expert'])) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $expertid = $row['expertid'];
                                            $status = $row['expertAccountStatus']? "Deactive" : "Active";
                                            echo '
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>' . $row['expertFullName'] . '</td>
                                            <td>' . $row['expertEmail'] . '</td>
                                            <td>' . $status .  '</td>
                                            <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                            <td><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal' . $expertid . '">Delete</button></td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal' . $expertid . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $expertid . '" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel' . $expertid . '">Delete user account</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you confirm to delete ' . $row['expertFullName'] . ' account? 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                        }
                                    }
                                } else {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $userid = $row['userid'];
                                            echo '
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>' . $row['userFullName'] . '</td>
                                            <td>' . $row['userEmail'] . '</td>
                                            <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                            <td><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal' . $userid . '">Delete</button></td>
                                            <td>' . $userid . '</td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal' . $userid . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $userid . '" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel' . $userid . '">Delete user account</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div> 
                                                <div class="modal-body">
                                                    Are you confirm to delete ' . $row['userFullName'] . ' account? 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="hidden" value="' . $userid . '" name="userid" />
                                                    <button type="submit" class="btn btn-danger" name="deleteuser" >Delete</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>