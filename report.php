<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>

    <div style="display: flex; justify-content: center;">
        <!-- <div style="margin-top: 150px; width: 900px; height: 450px; background-color: grey;"> -->
            <!-- <div class="" style="background-color: red; border-radius: 10px; margin-top: 150px"> -->
                <table class="table" style="width: 600px; margin-top: 160px; border-radius: 10px;">
                    <thead class="" style="background-color: #212529; color: white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>3</td>
                            <td>2</td>
                            <td>1</td>
                            <td>
                                <button class="" style="border: none; background-color: white;"><i class="fa fa-eye"
                                        style="background-color: white"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</body>

</html>