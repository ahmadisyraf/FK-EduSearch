<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100" style="padding-left: 100px; padding-right: 100px">
        <h3 class="mt-5">My Complaints</h3>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">All Complaint</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ComplaintID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Complaint</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col"style="width:20px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"style="width:10px">1</th>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>
                                <div class="alert alert-primary" role="alert">
                                    In-Investigation
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:10px">2</th>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>
                                <div class="alert alert-warning" role="alert">
                                    In-Hold
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:10px">3</th>
                            <td>....</td>
                            <td>....</td>
                            <td>....</td>
                            <td>...</td>
                            <td>
                                <div class="alert alert-success" role="alert">
                                    Resolved
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</body>

</html>