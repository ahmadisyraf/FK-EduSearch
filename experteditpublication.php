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
    <?php include "config/autoload.php"; ?>

    <?php

    $publication = new PublicationController();
    $userdata = json_decode($_COOKIE['user_data'], true);
    $success = false;
    $success = false;

    $cookie_userid = $userdata['uid'];

    $fetch = $publication->getPublicationCotroller($cookie_userid);

    if (isset($_POST['hantar'])) {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $category = $_POST['category'];

        $insert = $publication->insertPublicationController($title, $date, $category, $cookie_userid);

        if (!$insert) {
            $error = true;
        } else {
            $succes = true;
        }
    }

    function showSuccess()
    {
        return '
        <div class="alert alert-success" role="alert">
            Yeay! your publication added. Please refresh to see changes.
        </div>
        ';
    }

    function showError()
    {
        return '
        <div class="alert alert-danger" role="alert">
            Opps! seems there is a problem. Please try again.
        </div>
        ';
    }
    ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Publication List</h3>
        <?php echo $succes == true ? showSuccess() : NULL; ?>
        <?php echo $error == true ? showError() : NULL ?>
        <div class="card text-left w-90">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="experteditprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="experteditresearch.php">Research</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Publication</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($fetch && $fetch->num_rows > 0) {
                                    while($row = $fetch->fetch_assoc()) {
                                        $db_title = $row['publicationTitle'];
                                        $db_date = $row['publicationDate'];
                                        $db_category = $row['publicationCategory'];

                                        echo'
                                        <tr>
                                            <th scope="row">' .$db_title. '</th>
                                            <td>' .$db_date. '</td>
                                            <td>' . $db_category. '</td>
                                        </tr>
                                        ';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-bs-whatever="add">Add Publication</button>
                    </div>

                    <form action="" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Publication</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="publication-title" class="col-form-label">Title:</label>
                                            <input type="text" class="form-control" id="publication-title" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="publication-title" class="col-form-label">Date:</label>
                                            <input type="text" class="form-control" id="publication-title" name="date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="publication-cat" class="col-form-label">Category:</label>
                                            <input type="text" class="form-control" id="publication-cat"
                                                name="category">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark" name="hantar">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>