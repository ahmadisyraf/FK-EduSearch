<!--Purpose: Expert can edit their publication list -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Publication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php
        session_start();

        $_SESSION['logged_out'];
    
        if ($_SESSION['logged_out'] == true) {
            header("Location: index.php");
        }
    ?>

    <?php include "components/navigation.php"; ?>

    <div class="container-fluid px-5">
        <h3 class="mt-5">Publication List</h3>
        <div class="card text-left w-90">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="experteditprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="experteditacademic.php">Academic</a>
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
                <form action="DeletePublication.php" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include the database connection and query the publication data
                            include "config/autoload.php";

                            $publication = new ExpertController();
                            $result = $publication->getPublication($id);

                            // Iterate through the fetched data and populate table rows
                            $rowNumber = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th scope="row">' . $rowNumber . '</th>';
                                echo '<td>' . $row['publicationTitle'] . '</td>';
                                echo '<td>' . $row['publicationCategory'] . '</td>';
                                echo '<td>';
                                echo '<input type="checkbox" name="selectedPublications[]" value="' . $row['publicationTitle'] . '">';
                                echo '</td>';
                                echo '</tr>';
                                $rowNumber++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" name="deleteSelected" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                            Delete
                        </button>
                        <div style="margin-left: 10px;"></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                            </svg>
                            Add
                        </button>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Publication</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="addexpertpublication.php" method="post">
                                    <div class="mb-3">
                                        <label for="publicationTitle" class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" name="publicationTitle" id="publicationTitle">
                                    </div>
                                    <div class="mb-3">
                                        <label for="publicationCategory" class="col-form-label">Category:</label>
                                        <input type="text" class="form-control" name="publicationCategory" id="publicationCategory">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
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