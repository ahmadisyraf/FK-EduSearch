<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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

    $type = $_REQUEST['type']? $_REQUEST['type'] : "user";

    $search = "";

    $index = 0;

    if (isset($_POST['deleteuser'])) {
        $delete = $user->deleteUser($_POST['userid']);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_POST['admin'])) {
        header("Location: users.php?type=admin");
        exit();
    } else if (isset($_POST['expert'])) {
        $type = "expert";
    } else if (isset($_POST['user'])) {
        $type = "user";
    }

    if ($type == "admin") {
        $result = $admin->getAllAdmin();

        $click_user = false;
        $click_expert = false;
        $click_admin = true;
    } else if ($type == "expert") {

        $result = $expert->getAllExpert();
        $click_user = false;
        $click_expert = true;
        $click_admin = false;

        if (isset($_POST['submitsearch'])) {
            $search = $_REQUEST['search_keyword'];
            $result = $expert->searchExpertController($search);
        } else {
            $result = $expert->getAllExpert();
        }

    } else {
        if (isset($_POST['submitsearch'])) {
            $search = $_REQUEST['search_keyword'];
            $result = $user->searchUserController($search);
        } else {
            $result = $user->getAllUserController();
        }
    }

    $total_user = $user->getTotalUserController();
    $total_expert = $expert->getTotalExpertController();

    $total_all_user = $total_user + $total_expert;

    ?>

    <div class="d-flex justify-content-center">
        <div>
            <div class="d-flex justify-content-between" style="margin-top: 150px; margin-bottom: 5px; width: 1300px">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                        </ol>
                    </nav>
                    <h4>Manage User</h4>
                    <figcaption class="blockquote-footer mt-1">
                        <?php echo isset($total_all_user) ? $total_all_user : "N/A" ?> registered users
                    </figcaption>
                </div>
            </div>
            <form action="users.php" method="post" class="hstack gap-2" style="margin-bottom: 20px">
                <div style="width: 100%">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search name"
                        name="search_keyword">
                </div>
                <input type="hidden" name="type" value="<?php echo $type; ?>">
                <div class="">
                    <button type="submit" class="btn btn-dark" name="submitsearch" style="width: 100px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        Search
                    </button>
                </div>
                <div class="">
                    <a type="submit" class="btn btn-dark" href="adduser.php" style="width: 100px">Add User</a>
                </div>
            </form>
            <div class="card animate__animated animate__fadeInUp animate__fast" style="">
                <div class="card-body px-5">
                    <div class="mt-3 d-flex justify-content-between">
                        <h5>User List</h5>
                        <form action="" method="post">
                            <div class="nav nav-pills">
                                <div class="nav-item">
                                    <button type="submit"
                                        class="<?php echo ($type == "user" ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="user">User ( <?php echo isset($total_user) ? $total_user : 'N/A'; ?>
                                        )</button>
                                </div>
                                <div class="nav-item">
                                    <button type="submit"
                                        class="<?php echo ($type == "expert" ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="expert">Expert ( <?php echo isset($total_expert) ? $total_expert : 'N/A'; ?> )</button>
                                </div>
                                <!-- <div class="nav-item">
                                    <button type="submit"
                                        class="<?php //echo ($click_admin ? 'nav-link active bg-dark' : 'nav-link'); ?>"
                                        name="admin">Admin</button>
                                </div> -->
                            </div>
                        </form>
                    </div>
                    <table class="table mt-5" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <?php echo isset($_POST['expert']) ? '<th scope="col">Status</th>' : NULL ?>
                                <th scope="col">Update Profile</th>
                                <th scope="col">Online</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($type == "expert") {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $expertid = $row['expertid'];
                                        $status = $row['expertAccountStatus'] == "Active" ? "Active" : "Deactive";
                                        $profilestatus;
                                        $classprofilestatus;

                                        $index = $index + 1;

                                        $onlinestatus;
                                        $classonlinestatus;


                                        if ($row['expertUpdateProfileStatus'] == "Accepted") {
                                            $profilestatus = "Accepted";
                                            $classprofilestatus = "alert alert-success";
                                        } else if ($row['expertUpdateProfileStatus'] == "Pending") {
                                            $profilestatus = "Pending";
                                            $classprofilestatus = "alert alert-info";
                                        } else if ($row['expertUpdateProfileStatus'] == "Rejected") {
                                            $profilestatus = "Rejected";
                                            $classprofilestatus = "alert alert-danger";
                                        }

                                        if ($row['expertOnlineStatus'] == "Online") {
                                            $onlinestatus = "Online";
                                            $classonlinestatus = "alert alert-success";
                                        } else if ($row["expertOnlineStatus"] == "Offline") {
                                            $onlinestatus = "Offline";
                                            $classonlinestatus = "alert alert-danger";
                                        }


                                        echo '
                                        <tr>
                                            <th scope="row">' . $index . '</th>
                                            <td>' . $row['expertFullName'] . '</td>
                                            <td>' . $row['expertEmail'] . '</td>
                                            <td>' . $status . '</td>
                                            <td>
                                            <div class="' . $classprofilestatus . '" role="alert">
                                                ' . $profilestatus . '
                                            </div>
                                            </td>
                                            <td>
                                            <div class="' . $classonlinestatus . '">
                                                ' . $onlinestatus . '
                                            <div>
                                            </td>
                                            <td>
                                            <a href="edituser.php?userid=' . $expertid . '&type=expert">
                                                <button type="submit" class="btn btn-dark">Edit</button>
                                            </a>
                                            </td>
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
                                        $profilestatus;
                                        $classprofilestatus;

                                        $onlinestatus;
                                        $classonlinestatus;

                                        $index = $index + 1;

                                        if ($row['userUpdateProfileStatus'] == "Accepted") {
                                            $profilestatus = "Accepted";
                                            $classprofilestatus = "alert alert-success";
                                        } else if ($row['userUpdateProfileStatus'] == "Pending") {
                                            $profilestatus = "Pending";
                                            $classprofilestatus = "alert alert-info";
                                        } else if ($row['userUpdateProfileStatus'] == "Rejected") {
                                            $profilestatus = "Rejected";
                                            $classprofilestatus = "alert alert-danger";
                                        }

                                        if ($row['userOnlineStatus'] == "Online") {
                                            $onlinestatus = "Online";
                                            $classonlinestatus = "alert alert-success";
                                        } else if ($row['userOnlineStatus'] == "Offline") {
                                            $onlinestatus = "Offline";
                                            $classonlinestatus = "alert alert-danger";
                                        }

                                        echo '
                                        <tr>
                                            <th scope="row">' . $index . '</th>
                                            <td>' . $row['userFullName'] . '</td>
                                            <td>' . $row['userEmail'] . '</td>
                                            <td>
                                            <div class="' . $classprofilestatus . '" role="alert">
                                                ' . $profilestatus . '
                                            </div>
                                            </td>
                                            <td>
                                            <div class="' . $classonlinestatus . '" >
                                                ' . $onlinestatus . '
                                            </div>
                                            </td>
                                            <td>
                                             <a href="edituser.php?userid=' . $userid . '&type=user">
                                                <button type="submit" class="btn btn-dark" name="edit_button">Edit</button>
                                            </a>
                                            </td>
                                            <td><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal' . $userid . '">Delete</button></td>
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
                                } else if ($result->num_rows < 0) {
                                    echo "Not found";
                                } else {
                                    echo '
                                    <div class="alert alert-danger mt-3" role="alert">
                                        Opps! seems like there is an error
                                    </div>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>