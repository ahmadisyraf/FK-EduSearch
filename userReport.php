<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex flex-column justify-content-center align-item-center vh-100"
        style="padding-left: 400px; padding-right: 400px">
        <h3 class="mt-5">Report</h3>
        <div class="card text-center mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">Report List</a>
                    </li>
                </ul>
            </div>
            <div class="card-body shadow-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Likes</th>
                            <th scope="col" style="width:20px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "config/autoload.php";

                        $report = new ReportController();

                        // Call the getAllUserActivity() function
                        $result = $report->getAllUserActivity();

                        // Initialize an empty array to keep track of displayed users and their post counts
                        $displayedUsers = array();

                        // Check if there are any rows returned
                        if ($result && $result->num_rows > 0) {
                            $rowNumber = 1;

                            // Loop through each row of the result set
                            while ($row = $result->fetch_assoc()) {
                                $username = $row['username'];
                                $postTopic = $row['postTopic'];

                                // Check if the user has already been displayed
                                if (!in_array($username, array_column($displayedUsers, 'username'))) {
                                    // If the user has not been displayed, add the username to the displayedUsers array
                                    $displayedUsers[] = array(
                                        'username' => $username,
                                        'postCount' => 1
                                    );
                                } else {
                                    // If the user has already been displayed, increment the post count
                                    $index = array_search($username, array_column($displayedUsers, 'username'));
                                    $displayedUsers[$index]['postCount']++;
                                }
                            }

                            // Loop through the displayedUsers array to render the table rows
                            foreach ($displayedUsers as $user) {
                                $username = $user['username'];
                                $postCount = $user['postCount'];

                                // Call the getNumLikesForUser function to get the number of likes for the user
                                $likesResult = $report->getNumLikesForUser($username);
                                if ($likesResult && $likesResult->num_rows > 0) {
                                    $likeCount = $likesResult->fetch_assoc()['likeCount'];
                                } else {
                                    $likeCount = 0; // Set default value if no likes are found
                                }

                                $commentsResult = $report->getNumCommentsForUser($username);
                                if ($commentsResult && $commentsResult->num_rows > 0) {
                                    $commentCount = $commentsResult->fetch_assoc()['commentCount'];
                                } else {
                                    $commentCount = 0; // Set default value if no likes are found
                                }
                                ?>
                                <tr>
                                    <th scope="row" style="width:10px;" class="align-middle text-center">
                                        <?php echo $rowNumber; ?>
                                    </th>
                                    <td class="align-middle text-center">
                                        <?php echo $username; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php echo $postCount; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php echo $commentCount; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php echo $likeCount; ?>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex">
                                            <a href="userReportDetails.php?user=<?php echo urlencode($username); ?>">
                                                <button class="btn"><i class="fa fa-eye"></i></button>
                                            </a>
                                            <button class="btn btn-show-modal" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                <i class="fa fa-bar-chart"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $rowNumber++;
                            }
                        } else {
                            // Handle case when no rows are returned
                            ?>
                            <tr>
                                <td colspan="4">No data found.</td>
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

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User's Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3"><canvas id="chart" style="width:100%;"></canvas></div>
                    <script>
                        const data = {
                            labels: [
                                'Red',
                                'Green',
                                'Yellow',
                                'Grey',
                                'Blue'
                            ],
                            datasets: [{
                                label: 'My First Dataset',
                                data: [11, 16, 7, 3, 14],
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    'rgb(201, 203, 207)',
                                    'rgb(54, 162, 235)'
                                ]
                            }]
                        };
                        const config = {
                            type: 'polarArea',
                            data: data,
                            options: {}
                        };
                        new Chart("chart", config);
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        // Wait for the document to be ready
        $(document).ready(function () {
            // Add a click event listener to the button with class "btn-show-modal"
            $(".btn-show-modal").click(function () {
                // Show the modal by targeting its ID
                $("#exampleModalCenter").modal("show");
            });

            // Add a click event listener to the close button and overlay of the modal
            $(".modal").on("hidden.bs.modal", function () {
                // Remove the modal backdrop when the modal is hidden
                $(".modal-backdrop").remove();
            });
        });
    </script>
</body>

</html>