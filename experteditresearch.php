<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Research</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php" ?>

    <?php
    $research = new ResearchController();

    $userdata = json_decode($_COOKIE['user_data'], true);
    $adminid = $userdata['uid'];
    $success = false;
    $error = false;

    $db_data = $research->getResearch($adminid);

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        $result = $research->insertResearchController($adminid, $title, $role, $status);

        if ($result) {
            $succes = true;
        } else {
            $error = true;
        }
    }


    ?>


    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Research List</h3>
        <?php

        if ($succes == true) {
            echo '
            <div class="alert alert-success" role="alert">
                Success add research paper, please refresh.
            </div>  
            ';
        } else if ($error == true) {
            echo '
            <div class="alert alert-danger" role="alert">
                Opps, there is an error. Try again later
            </div>
            ';
        }
        ?>
        <div class="card text-left w-90">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="experteditprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Research</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="experteditpublication.php">Publication</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- <form class="row g-3"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($db_data) {
                            if ($db_data->num_rows > 0) {
                                while ($row = $db_data->fetch_assoc()) {
                                    // $db_title = $row['researchPaperTitle'];
                                    // $db_role = $row['researchRole'];
                                    // $db_role = $row['researchStatus'];

                                    echo '
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>'. $row['researchPaperTitle'].'</td>
                                        <td>' . $row['researchRole']. '</td>
                                        <td>
                                            <div class="alert alert-primary" role="alert">
                                            ' . $row['researchStatus']. '
                                            </div>
                                        </td>
                                    </tr>
                                    ';
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Modal -->
                <form action="" method="post">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-bs-whatever="add">Add Research</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Research</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- <form action="../FK-EduSearch/classes/ExpertResearchAdd.php" method="post"> -->

                                        <div class="mb-3">
                                            <label for="research-title" class="col-form-label">Title:</label>
                                            <input type="text" class="form-control" id="research-title" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="research-role" class="col-form-label">Role:</label>
                                            <input type="text" class="form-control" id="research-role" name="role">
                                        </div>
                                        <div class="mb-3">
                                            <label for="research-status" class="col-form-label">Current
                                                Status:</label>
                                            <input type="text" class="form-control" id="research-status" name="status">
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark" name="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>