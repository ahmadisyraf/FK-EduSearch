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
    <style>
        .page-item.active a {
            background-color: #212529;
            border-color: #dee2e6;
        }
    </style>
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
        style="padding-left: 400px; padding-right: 400px">
        <h3 class="mt-5">Number of Posts</h3>
        <div class="card text-center mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#day" data-bs-toggle="tab">Per Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#week" data-bs-toggle="tab">Per Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#month" data-bs-toggle="tab">Per Month</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#summary" data-bs-toggle="tab">Summary</a>
                    </li>
                </ul>
            </div>
            <?php
            include "config/autoload.php";

            $reportController = new ReportController();
            $dayResult = $reportController->getAllPost();
            $weekResult = $reportController->getAllPost();
            $monthResult = $reportController->getAllPost();

            // Process the data for the day chart
            $dayLabels = array();
            $dayData = array();
            $currentWeekStart = new DateTime('last Sunday'); // Get the start of the current week
            $currentWeekEnd = clone $currentWeekStart;
            $currentWeekEnd->modify('+6 days'); // Get the end of the current week
            
            // Loop through the days of the current week
            $currentDay = clone $currentWeekStart;
            while ($currentDay <= $currentWeekEnd) {
                $day = $currentDay->format('F j'); // Format the date as "Month Day"
            
                $dayLabels[] = $day;
                $dayData[$day] = 0; // Initialize the count for the day
            
                $currentDay->modify('+1 day'); // Move to the next day
            }

            // Retrieve the post data
            while ($row = mysqli_fetch_assoc($dayResult)) {
                $postDate = new DateTime($row['postDate']);

                // Check if the post date falls within the current week
                if ($postDate >= $currentWeekStart && $postDate <= $currentWeekEnd) {
                    $day = $postDate->format('F j'); // Format the date as "Month Day"
            
                    // Increment the count for the day
                    $dayData[$day]++;
                }
            }

            ksort($dayLabels); // Sort the day labels in ascending order by date
            
            // Process the data for the week chart
            $weekLabels = array();
            $weekData = array();
            $currentMonth = date('F'); // Get the current month
            $processedWeeks = array(); // Array to store processed weeks
            
            while ($row = mysqli_fetch_assoc($weekResult)) {
                $postDate = new DateTime($row['postDate']);
                $month = $postDate->format('F'); // Get the month of the post
            
                if ($month == $currentMonth) { // Check if the post belongs to the current month
                    $weekStart = clone $postDate;
                    $weekStart->modify('last Sunday'); // Get the start of the week
            
                    $weekEnd = clone $weekStart;
                    $weekEnd->modify('next Saturday'); // Get the end of the week
            
                    $weekLabel = $weekStart->format('M j') . ' - ' . $weekEnd->format('M j'); // Combine the start and end dates
            
                    if (!in_array($weekLabel, $processedWeeks)) {
                        $weekLabels[] = $weekLabel;
                        $weekData[$weekLabel] = 1;
                        $processedWeeks[] = $weekLabel;
                    } else {
                        $weekData[$weekLabel]++;
                    }

                    if (count($processedWeeks) == 4) {
                        break; // Break the loop after processing four distinct weeks
                    }
                }
            }

            ksort($weekLabels); // Sort the week labels in ascending order by date
            
            // If less than four weeks are found, add empty entries to display four weeks
            while (count($weekLabels) < 4) {
                $weekLabels[] = '';
                $weekData[''] = 0;
            }



            // Process the data for the month chart
            $monthLabels = array();
            $monthData = array();
            while ($row = mysqli_fetch_assoc($monthResult)) {
                $month = date('F Y', strtotime($row['postDate'])); // Format the date as "Month Year"
                if (!in_array($month, $monthLabels)) {
                    $monthLabels[] = $month;
                    $monthData[$month] = 1;
                } else {
                    $monthData[$month]++;
                }
            }
            ksort($monthLabels); // Sort the month labels in ascending order by date
            
            ?>
            <div class="card-body shadow-sm">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="day">
                        <div class="p-3"><canvas id="chart1" style="width:100%;"></canvas></div>
                        <script>
                            const labels1 = <?php echo json_encode($dayLabels); ?>;
                            const data1 = {
                                labels: labels1,
                                datasets: [{
                                    label: 'Posts per day on current week',
                                    data: <?php echo json_encode(array_values($dayData)); ?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            const config1 = {
                                type: 'bar',
                                data: data1,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                        }
                                    }
                                },
                            };

                            new Chart("chart1", config1);
                        </script>
                    </div>

                    <div class="tab-pane fade" id="week">
                        <div class="p-3"><canvas id="chart2" style="width:100%;"></canvas></div>
                        <script>
                            const labels2 = <?php echo json_encode($weekLabels); ?>;
                            const data2 = {
                                labels: labels2,
                                datasets: [{
                                    label: 'Posts per week on current month',
                                    data: <?php echo json_encode(array_values($weekData)); ?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            const config2 = {
                                type: 'bar',
                                data: data2,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                },
                            };

                            new Chart("chart2", config2);
                        </script>
                    </div>

                    <div class="tab-pane fade" id="month">
                        <div class="p-3"><canvas id="chart3" style="width:100%;"></canvas></div>
                        <script>
                            const labels3 = <?php echo json_encode($monthLabels); ?>;
                            const data3 = {
                                labels: labels3,
                                datasets: [{
                                    label: 'Posts per month on current year',
                                    data: <?php echo json_encode(array_values($monthData)); ?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            const config3 = {
                                type: 'bar',
                                data: data3,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                },
                            };

                            new Chart("chart3", config3);
                        </script>
                    </div>

                    <div class="tab-pane fade" id="summary">
                        <div style="width: 400px;" class="row">
                            <div class="col-10">
                                <form action="" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Search keyword">
                                        <button type="submit" class="btn"
                                            style="background: #212529; color: white;">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2" style="padding-top: 5px">
                                <a href="/FK-EDUSEARCH/postReport.php" type="button" style="color: #212529;">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                        $summary = new ReportController();
                        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL query string
                        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                        $postsPerPage = 5;
                        $offset = ($page - 1) * $postsPerPage;

                        $posts = $summary->searchPost($keyword);
                        $totalPosts = mysqli_num_rows($posts);
                        $totalPages = ceil($totalPosts / $postsPerPage);
                        ?>
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
                                if ($posts) {
                                    $startIndex = $offset + 1;
                                    $count = $startIndex;
                                    mysqli_data_seek($posts, $offset); // Move the pointer to the start position
                                
                                    while ($row = mysqli_fetch_assoc($posts)) {
                                        // Display only the posts for the current page
                                        if ($count > $startIndex + $postsPerPage - 1) {
                                            break;
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row" style="width:10px;" class="align-middle text-center">
                                                <?php echo $count; ?>
                                            </th>
                                            <td class="align-middle text-center">
                                                <?php echo $row['postTopic']; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php echo $row['postContent']; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php echo $row['postCategory']; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php echo date('Y-m-d', strtotime($row['postDate'])); ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav>
                            <div style="float: left; font-weight: bold">
                                Total Posts:
                                <?php echo $totalPosts; ?>
                            </div>
                            <ul class="pagination justify-content-end">
                                <?php
                                // Display pagination links
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    $pageLink = "?page=" . $i . "&keyword=" . urlencode($keyword);
                                    ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>"
                                            href="?page=<?php echo $i; ?>">
                                            <span style="color: <?php echo ($i == $page) ? '#ffffff' : '#000000'; ?>"><?php echo $i; ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>