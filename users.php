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

    <?php include "components/navigation.php"; ?>
    <?php include "components/sidebar.php" ?>

    <div class="d-flex justify-content-center wv-100">
        <div>
            <div class="d-flex justify-content-between" style="margin-top: 200px; margin-bottom: 30px; width: 100%">
                <h4>Manage User</h4>
                <button type="submit" class="btn btn-dark">Add User</button>
            </div>
            <div class="card" style="">
                <div class="card-body px-5">
                    <div class="mt-3 d-flex justify-content-between">
                        <h5>User List</h5>
                        <div class="d-flex">
                            <input type="text" class="form-control me-2" id="exampleFormControlInput1"
                                placeholder="search">
                            <!-- <button type="submit" class="btn btn-dark">Search</button> -->
                        </div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</td>
                                <td>isyrafmagic@gmail.com</td>
                                <td>Admin</td>
                                <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                <td><button type="submit" class="btn btn-outline-dark">Delete</button></td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</td>
                                <td>isyrafmagic@gmail.com</td>
                                <td>Admin</td>
                                <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                <td><button type="submit" class="btn btn-outline-dark">Delete</button></td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</td>
                                <td>isyrafmagic@gmail.com</td>
                                <td>Admin</td>
                                <td><button type="submit" class="btn btn-dark">Edit</button></td>
                                <td><button type="submit" class="btn btn-outline-dark">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>