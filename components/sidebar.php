<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FK-EduSearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dashboard</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-absolute">
            <ul class="list-group">


                <!-- <?php session_start() ?> -->
                <?php echo $_SESSION["role"] == "admin"? '<a class="list-group-item" href="users.php">Manage User</a>' : NULL?>
                <?php echo $_SESSION["role"] == "expert"? '<a class="list-group-item" href="experteditprofile.php">Profile</a>' : NULL?>
                <?php echo $_SESSION["role"] == "expert"? '<a class="list-group-item" href="experteditpublication.php">Publication</a>' : NULL?>
                <?php echo $_SESSION["role"] == "expert"? '<a class="list-group-item" href="experteditresearch.php">Research</a>' : NULL?>
                <?php echo $_SESSION["role"] == "expert"? '<a class="list-group-item" href="expertReport.php">Reports</a>' : NULL?>
                <?php echo $_SESSION["role"] == "admin" ? '<li class="list-group-item"><form action="users.php" method="post"><input type="hidden" name="type" value="user"/><button class="btn btn-link px-0 py-0 pt-0 pb-0 text-decoration-none text-dark">Manage User</button></form></li>' : NULL ?>
                <?php echo $_SESSION['role'] == "admin" ? '<li class="list-group-item"><a href="userReport.php" class="text-decoration-none text-dark">User Report</a></li>' : '' ?>
                <?php echo $_SESSION['role'] == "admin" ? '<li class="list-group-item"><a href="feedbackreport.php" class="text-decoration-none text-dark">User feedback</a></li>' : '' ?>
                <?php echo $_SESSION['role'] == "admin" ? '<li class="list-group-item"><a href="admincomplaint.php" class="text-decoration-none text-dark">Admin Complaint</a></li>' : '' ?>
                <li class="list-group-item">Complaint</li>
                <?php echo (($_SESSION['role'] !== "admin") ? '<li class="list-group-item"><a href="feedback.php" class="text-decoration-none text-dark">Give us feedback</a></li>' : '') ?>
              

            </ul>
        </div>
    </div>

</body>

</html>