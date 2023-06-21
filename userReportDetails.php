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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <?php include "components/navigation.php"; ?>

    <div class="d-flex flex-column justify-content-center align-item-center vh-100"
        style="padding-left: 200px; padding-right: 200px">
        <div class="row">
            <div class="col-md">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="userReport.php">User Activity</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User's Posts</li>
                    </ol>
                </nav>
                <h3 class="mt-5">User's Posts</h3>
                <div class="card text-center mt-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="#">Post List</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body shadow-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Posts</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "config/autoload.php";

                                // Assuming you retrieve the username from the URL parameter 'user'
                                $username = $_GET['user'];

                                // Assuming $postController is an instance of PostController
                                $reportDetails = new ReportController();

                                // Call the getPostsByUsername() function to retrieve the user's posts
                                $results = $reportDetails->getPostsByUsername($username);

                                // Check if there are any posts returned
                                if ($results && $results->num_rows > 0) {
                                    $rowNumber = 1;
                                    $posts = [];

                                    // Fetch rows and store them in an array
                                    while ($row = $results->fetch_assoc()) {
                                        $posts[] = $row;
                                    }

                                    // Loop through each post
                                    foreach ($posts as $post) {
                                        $postTopic = $post['postTopic'];
                                        $postContent = $post['postContent'];
                                        $postCategory = $post['postCategory'];
                                        $postDate = $post['postDate'];
                                        ?>
                                        <tr>
                                            <th scope="row" style="width:10px">
                                                <?php echo $rowNumber; ?>
                                            </th>
                                            <td>
                                                <?php echo $postTopic; ?>
                                            </td>
                                            <td>
                                                <?php echo $postContent; ?>
                                            </td>
                                            <td>
                                                <?php echo $postCategory; ?>
                                            </td>
                                            <td>
                                                <?php echo date('Y-m-d', strtotime($postDate)); ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $rowNumber++;
                                    }
                                } else {
                                    // Handle case when no posts are found for the user
                                    ?>
                                    <tr>
                                        <td colspan="2">No posts found for this user.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm mt-5">
                <div class="mt-5"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                <script>
                    var xValues = ["Posts", "Comments", "Likes"];
                    var yValues = [55, 49, 44];
                    var barColors = [
                        "#b91d47",
                        "#00aba9",
                        "#2b5797",
                    ];

                    new Chart("myChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        // options: {
                        //     title: {
                        //         display: true,
                        //         text: "World Wide Wine Production 2018"
                        //     }
                        // }
                    });
                </script>
            </div> -->
        </div>
    </div>
</body>

</html>