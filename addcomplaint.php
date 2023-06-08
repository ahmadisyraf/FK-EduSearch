<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <div class="container-fluid px-5">
        <h3 class="mt-5">Complaints</h3>
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
                            <th scope="col" style="width:20px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="width:10px">1</th>
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
                <a href="#" class="btn" style="color:white; background-color: #080202; width:100px">Back</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn" style="color:white; background-color: #080202; width:100px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Complaint
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Complaint</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label d-flex">Email
                                        address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label d-flex">Description</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput2"
                                        placeholder="....">
                                </div>
                                <label for="exampleFormControlInput4" class="form-label d-flex">Complaint Type</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Unsatisfied Expert's Feedback</option>
                                    <option value="2">Wrongly Assigned Research Area</option>
                                    <option value="3">Other</option>
                                </select>
                                <form action="/action_page.php">
                                    <label for="example">Date</label>
                                    <input style="width:150px" type="datetime-local" id="birthdaytime"
                                        name="birthdaytime">
                                </form>
                                <form action="/action_page.php">
                                    <label for="appt">Select a time:</label>
                                    <input type="time" id="appt" name="appt">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a href="#" style="color:white; background-color: #080202; width:100px"
                                    class="btn">Back</a>
                                <button type="button" style="color:white; background-color: #080202; width:100px">Add Complaint</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>