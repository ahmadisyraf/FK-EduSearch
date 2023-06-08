<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <div class="container-fluid px-5">
        <h3 class="mt-5">Complaint Details</h3>
        <div class="card text-center w-50">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">EP1</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control"  aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                <span class="input-group-text">Email</span>
                    <input type="text" class="form-control"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text">Date</span>
                    <input type="text" class="form-control"
                        aria-label="" aria-describedby="basic-addon2">
                </div>

                <div class="input-group mb-3">
                <span class="input-group-text">Time</span>
                    <input type="text" class="form-control"
                        aria-label="" aria-describedby="basic-addon2">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Complaint Type</span>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>

                <div class="input-group mb-3">
                <span class="input-group-text">Status</span>
                    <input type="text" class="form-control"
                        aria-label="" aria-describedby="basic-addon2">
                </div>

                <div class="input-group">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
                <br>
                <a href="#" style="color:white; background-color: #080202; width:100px" class="btn" >Back</a>
            </div>
        </div>
    </div>
</body>

</html>