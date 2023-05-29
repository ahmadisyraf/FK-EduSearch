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

    <div class="d-flex justify-content-center pt-5">
        <div class="card mt-5" style="width: 40%">
            <!-- <div class="card-header">
                    User profile here
                </div>
                <div class="card-body">
                    Hello world!
                </div>
                <div class="card-footer">
                    Footer are here
                </div> -->
                <!-- aiman -->
            <div class="card-body">
                <div class="d-flex">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                        class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                    <div class="row">
                        <h6 class="inline my-0">AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</h6>
                        <p><u>Software Engineering</u>. Posted on May 27</p>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="my-0"><b>Why are laravel better than other framework?</b></p>
                    <p>I want to create MVC framework for my SDW project by using Laravel. I want to know is Laravel is
                        better than other framework and what the advantages of Laravel.</p>

                    <img class="img-fluid" src="https://www.jesusamieiro.com/wp-content/uploads/2019/10/Laravel.png" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>