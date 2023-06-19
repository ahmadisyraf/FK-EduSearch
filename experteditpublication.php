<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Research</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $success = true;
            echo '<script>
                    
                      setTimeout(function() {
                          window.location.href = "experteditpublication.php";
                      }, 2000); // Redirect after 2 seconds
                  </script>';
        }
    }


    if (isset($_POST['update'])) {
        $publicationId = $_POST['publicationid'];
        $title = $_POST['editTitle'];
        $category = $_POST['editCategory'];

        $update = $publication->updatePublication($publicationId, $title, $category);

        if (!$update) {
            $error = true;
        } else {
            $success = true;
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "experteditpublication.php";
                    }, 2000); // Redirect after 2 seconds
                  </script>';
        }
    }





    ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Publication List</h3>

        <div class="card text-left w-90">
            <?php
            if ($error == true) {
                echo '
                            <div class="alert alert-danger w-100" role="alert">'
                    . $show_message .
                    '</div>';
            } else if ($success == true) {
                echo '
                            <div class="alert alert-success w-100" role="alert">
                                Action successful (Refreshing this page in 2 seconds)
                            </div>';
            }
            ?>
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
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Select</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rowCounter = 1;
                            if ($fetch && $fetch->num_rows > 0) {
                                while ($row = $fetch->fetch_assoc()) {
                                    $db_id = $row['publicationid'];
                                    $db_title = $row['publicationTitle'];
                                    $db_date = $row['publicationDate'];
                                    $db_category = $row['publicationCategory'];

                                    echo '<tr>';
                                    echo '<th scope="row">' . $rowCounter . '</th>';
                                    echo '<td>' . $db_title . '</td>';
                                    echo '<td>' . $db_date . '</td>';
                                    echo '<td>' . $db_category . '</td>';
                                    echo '<td>';
                                    echo '<input type="checkbox" name="selectedPublications[]" value="' . $db_id . '">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-publication-id="' . $db_id . '" data-publication-title="' . $db_title . '" data-publication-category="' . $db_category . '">Edit</a>';
                                    echo '</td>';
                                    echo '</tr>';

                                    // Increment the counter
                                    $rowCounter++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>

                    <!-- Edit Publication Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Publication</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label for="edit-title" class="col-form-label">Title:</label>
                                            <input type="text" class="form-control" id="edit-title" name="editTitle" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-category" class="col-form-label">Category:</label>
                                            <select class="form-control" id="edit-category" name="editCategory">
                                                <option value="" disabled>Please Choose</option>
                                                <option value="UMP-IR">UMP-IR</option>
                                                <option value="Scopus">Scopus</option>
                                                <option value="ORCID">ORCID</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="publicationid" value="">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark" name="update">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).on('click', '[data-bs-target="#editModal"]', function() {
                            var title = $(this).data('publication-title');
                            var category = $(this).data('publication-category');
                            var publicationId = $(this).data('publication-id');

                            $('#editModal #edit-title').val(title);
                            $('#editModal #edit-category').val(category);
                            $('#editModal input[name="publicationid"]').val(publicationId);
                        });
                    </script>




                    <!-- Add Publication Modal -->
                    <div class="col-md-2">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="add">Add Publication</button>
                    </div>

                    <form action="" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Publication</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="publication-title" class="col-form-label">Title:</label>
                                            <input type="text" class="form-control" id="publication-title" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="publication-date" class="col-form-label">Date:</label>
                                            <input type="text" class="form-control" id="publication-date" name="date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="publication-cat" class="col-form-label">Category:</label>
                                            <select class="form-control" id="publication-cat" name="category">
                                                <option value="" disabled selected>Please Choose</option>
                                                <option value="UMP-IR">UMP-IR</option>
                                                <option value="Scopus">Scopus</option>
                                                <option value="ORCID">ORCID</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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