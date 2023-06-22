<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex flex-column justify-content-center align-item-center vh-100"
        style="padding-left: 400px; padding-right: 400px">
        <!-- Card -->
        <?php
        include "config/autoload.php";

        $reportDetails = new ReportController();

        $userStatuses = $reportDetails->getAllUserOnlineStatus();
        $expertStatuses = $reportDetails->getAllExpertOnlineStatus();
        $expertAccountStatuses = $reportDetails->getAllExpertAccountStatus();

        if ($userStatuses) {
            $totalUsers = mysqli_num_rows($userStatuses);
            $onlineCount = 0;

            while ($row = mysqli_fetch_assoc($userStatuses)) {
                $status = trim(strtolower($row['userOnlineStatus']));
                if ($status == 'online') {
                    $onlineCount++;
                }
            }

            $offlineCount = $totalUsers - $onlineCount;
            $onlinePercentage = ($totalUsers > 0) ? ($onlineCount / $totalUsers) * 100 : 0;
            $offlinePercentage = 100 - $onlinePercentage;
        } else {
            $totalUsers = 0;
            $onlineCount = 0;
            $offlineCount = 0;
            $onlinePercentage = 0;
            $offlinePercentage = 0;
        }

        if ($expertStatuses) {
            $totalExperts = mysqli_num_rows($expertStatuses);
            $onlineExpertCount = 0;

            while ($row = mysqli_fetch_assoc($expertStatuses)) {
                $status = trim(strtolower($row['expertOnlineStatus']));
                if ($status == 'online') {
                    $onlineExpertCount++;
                }
            }

            $offlineExpertCount = $totalExperts - $onlineExpertCount;
        } else {
            $totalExperts = 0;
            $onlineExpertCount = 0;
            $offlineExpertCount = 0;
        }

        if ($expertAccountStatuses) {
            $totalExpertAccounts = mysqli_num_rows($expertAccountStatuses);
            $activeExpertCount = 0;

            while ($row = mysqli_fetch_assoc($expertAccountStatuses)) {
                $status = trim(strtolower($row['expertAccountStatus']));
                if ($status == 'active') {
                    $activeExpertCount++;
                }
            }

            $deactivatedExpertCount = $totalExpertAccounts - $activeExpertCount;
        } else {
            $totalExpertAccounts = 0;
            $activeExpertCount = 0;
            $deactivatedExpertCount = 0;
        }

        $totalOnline = $onlineCount + $onlineExpertCount;
        $offlineTotal = $offlineCount + $offlineExpertCount;
        $onlinePercentage = (($totalUsers + $totalExperts) > 0) ? ($totalOnline / ($totalUsers + $totalExperts)) * 100 : 0;
        $offlinePercentage = 100 - $onlinePercentage;
        ?>

        <div class="card-deck" style="margin-top: 130px">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold;">Users Online</h5>
                    <p class="card-text" style="padding-top: 10px">
                        <span style="font-size: 30px;">
                            <?php echo $totalOnline . '/' . ($totalUsers + $totalExperts); ?>
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $onlinePercentage; ?>%; background-color: #212529;"
                            aria-valuenow="<?php echo $onlinePercentage; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round($onlinePercentage) . '%'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold;">Users Offline</h5>
                    <p class="card-text" style="padding-top: 10px">
                        <span style="font-size: 30px;">
                            <?php echo $offlineTotal . '/' . ($totalUsers + $totalExperts); ?>
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $offlinePercentage; ?>%; background-color: #212529;"
                            aria-valuenow="<?php echo $offlinePercentage; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round($offlinePercentage) . '%'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title" style="font-weight: bold;">Expert's Status</h5>
                    <div class="hstack gap-1">
                        <div class="vstack">
                            <p style="margin-bottom: 0px;">Active</p>
                            <p style="margin-bottom: 0px;">
                                <span style="font-size: 30px;">
                                    <?php echo $activeExpertCount; ?>
                                </span>
                            </p>
                        </div>
                        <div style="border-left: 2px solid black; height: 55px; margin-top: 5px;"></div>
                        <!-- Add this line for the vertical divider -->
                        <div class="vstack" style="width: 45px;">
                            <p style="margin-bottom: 0px;">Deactive</p>
                            <p style="margin-bottom: 0px;">
                                <span style="font-size: 30px;">
                                    <?php echo $deactivatedExpertCount; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?php echo ($activeExpertCount / $totalExpertAccounts) * 100; ?>%; background-color: #212529;"
                            aria-valuenow="<?php echo ($activeExpertCount / $totalExpertAccounts) * 100; ?>"
                            aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($activeExpertCount / $totalExpertAccounts) * 100) . '%'; ?>
                        </div>
                        <div class="progress-bar" role="progressbar"
                            style="width: <?php echo ($deactivatedExpertCount / $totalExpertAccounts) * 100; ?>%; background-color: #e9ecef; color: black;"
                            aria-valuenow="<?php echo ($deactivatedExpertCount / $totalExpertAccounts) * 100; ?>"
                            aria-valuemin="0" aria-valuemax="100">
                            <?php echo round(($deactivatedExpertCount / $totalExpertAccounts) * 100) . '%'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">User's Activity</h3>
        <div class="card text-center mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">User List</a>
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
                        // include "config/autoload.php";
                        
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
                                                data-target="#exampleModalCenter" data-username="<?php echo $username; ?>">
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
                <!-- ... existing HTML code ... -->

                <div class="modal-body">
                    <div class="p-3">
                        <canvas id="chart" style="width:100%;"></canvas>
                    </div>

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
        var chartInstance;
        // Wait for the document to be ready
        $(document).ready(function () {
            // Add a click event listener to the button with class "btn-show-modal"
            $(".btn-show-modal").click(function () {
                if (chartInstance) {
                    chartInstance.destroy();
                }

                // Get the username from the data-username attribute of the clicked button
                var username = $(this).data("username");

                // Retrieve the user's data from the selected row
                var row = $(this).closest("tr");
                var postCount = parseInt(row.find("td:nth-child(3)").text());
                var commentCount = parseInt(row.find("td:nth-child(4)").text());
                var likeCount = parseInt(row.find("td:nth-child(5)").text());

                // Prepare the chart data for the selected user
                var data = {
                    labels: ['Posts', 'Comments', 'Likes'],
                    datasets: [{
                        label: 'User Activity',
                        data: [postCount, commentCount, likeCount],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(75, 192, 192)',
                            'rgb(255, 205, 86)',
                        ]
                    }]
                };

                // Set up the chart configuration
                var config = {
                    type: 'polarArea',
                    data: data,
                    options: {}
                };

                // Create the chart
                chartInstance = new Chart("chart", config);

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