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
    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Research List</h3>
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
                <form class="row g-3">
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
                        <tr>
                        <th scope="row">1</th>
                        <td>Attendance Management System: I-Hadir</td>
                        <td>Leader</td>
                        <td>
                            <div class="alert alert-primary" role="alert">
                                On-Going
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Moh Service: An Adaptive Service Provider Platform</td>
                        <td>Leader</td>
                        <td>
                            <div class="alert alert-primary" role="alert">
                                On-Going
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Development Of Virtual Reality Training For Fire Safety</td>
                        <td>Member</td>
                        <td>
                            <div class="alert alert-success" role="alert">
                                Finished
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>

                <!-- Modal -->
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="add">Add Research</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Research</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="../FK-EduSearch/classes/ExpertResearchAdd.php" method="post">

                                <div class="mb-3">
                                    <label for="research-title" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" id="research-title">
                                </div>
                                <div class="mb-3">
                                    <label for="research-role" class="col-form-label">Role:</label>
                                    <input type="text" class="form-control" id="research-role">
                                </div>
                                <div class="mb-3">
                                    <label for="research-status" class="col-form-label">Current Status:</label>
                                    <input type="text" class="form-control" id="research-status">
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
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