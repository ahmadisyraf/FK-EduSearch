<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body style="margin-top:100px;">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex flex-column justify-content-center align-item-center vh-500 animate__animated animate__fadeInUp" style="padding-left: 400px; padding-right: 400px">
        <div class="breadcrumbs" style="margin-bottom: 10px;">
            <form action="" method="complaint" class="hstack gap-2">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="admincomplaint.php"> Admin Complaint</a></li>
                        <li class="breadcrumb-item"><a href="complaintReport.php"> Complaint Report</a></li>
                    </ol>
                </nav>
        </div>
        <h3 class="mt-5 animate__animated animate__fadeInUp">Number of Complaints</h3>
        <div class="card text-center mt-4">
            <div class="card-header animate__animated animate__fadeInUp">
                <ul class="nav nav-tabs card-header-tabs animate__animated animate__fadeInUp">
                    <li class="nav-item animate__animated animate__fadeInUp">
                        <a class="nav-link active" href="#day" data-bs-toggle="tab">Per Day</a>
                    </li>
                    <li class="nav-item animate__animated animate__fadeInUp">
                        <a class="nav-link" href="#week" data-bs-toggle="tab">Per Week</a>
                    </li>
                    <li class="nav-item animate__animated animate__fadeInUp">
                        <a class="nav-link" href="#month" data-bs-toggle="tab">Per Month</a>
                    </li>
                </ul>
            </div>

            <?php
            include "config/autoload.php";

            $complaintController = new complaintController();
            $dayResult = $complaintController->getAllUserComplaint();
            $weekResult = $complaintController->getAllUserComplaint();
            $monthResult = $complaintController->getAllUserComplaint();

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

            // Retrieve the complaint data
            while ($row = mysqli_fetch_assoc($dayResult)) {
                $complaintDate = new DateTime($row['complaintDate']);

                // Check if the complaint date falls within the current week
                if ($complaintDate >= $currentWeekStart && $complaintDate <= $currentWeekEnd) {
                    $day = $complaintDate->format('F j'); // Format the date as "Month Day"

                    // Increment the count for the day
                    $dayData[$day]++;
                }
            }

            ksort($dayLabels); // Sort the day labels in ascending order by date

            // Process the data for the week chart
            // Process the data for the week chart
            $weekLabels = array();
            $weekData = array();
            $currentMonth = date('F'); // Get the current month
            $processedWeeks = array(); // Array to store processed weeks

            // Get the start and end dates of the current month
            $currentMonthStart = new DateTime('first day of this month');
            $currentMonthEnd = new DateTime('last day of this month');

            while ($row = mysqli_fetch_assoc($weekResult)) {

                $complaintDate = new DateTime($row['complaintDate']);
                $month = $complaintDate->format('F'); // Get the month of the complaint

                if ($complaintDate >= $currentMonthStart && $complaintDate <= $currentMonthEnd) { // Check if the complaint belongs to the current month
                    $weekStart = clone $complaintDate;
                    $weekStart->modify('last Sunday'); // Get the start of the week

                    $weekEnd = clone $weekStart;
                    $weekEnd->modify('next Saturday'); // Get the end of the week

                    $weekLabel = $weekStart->format('M j') . ' - ' . $weekEnd->format('M j'); // Combine the start and end dates

                    if (isset($weekData[$weekLabel])) {
                        $weekData[$weekLabel]++;
                    } else {
                        $weekData[$weekLabel] = 1;
                    }

                    if (count($processedWeeks) >= 4) {
                        break; // Break the loop after processing four distinct weeks
                    }
                }
            }

            // Retrieve distinct weeks within the current month
            $distinctWeeks = array_keys($weekData);

            // Sort the distinct weeks in ascending order
            sort($distinctWeeks);

            // Populate the week labels array
            foreach ($distinctWeeks as $week) {
                $weekLabels[] = $week;
            }

            // If less than four weeks are found, add empty entries to display four weeks
            while (count($weekLabels) < 4) {
                $weekLabels[] = '';
                $weekData[''] = 0;
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
                $month = date('F Y', strtotime($row['complaintDate'])); // Format the date as "Month Year"
                if (!in_array($month, $monthLabels)) {
                    $monthLabels[] = $month;
                    $monthData[$month] = 1;
                } else {
                    $monthData[$month]++;
                }
            }

            ksort($monthLabels); // Sort the month labels in ascending order by date

            ?>
            <div class="card-body shadow-sm animate__animated animate__fadeInUp">
                <div class="tab-content animate__animated animate__fadeInUp">
                    <div class="tab-pane fade show active animate__animated animate__fadeInUp" id="day">
                        <div class="p-3 animate__animated animate__fadeInUp"><canvas id="chart1" style="width:100%;"></canvas></div>
                        <script>
                            const labels1 = <?php echo json_encode($dayLabels); ?>;
                            const data1 = {
                                labels: labels1,
                                datasets: [{
                                    label: 'Complaint per day on current week',
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
                                    label: 'Complaint per week on current month',
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
                                    label: 'Complaint per month on current year',
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

                </div>

            </div>

        </div>
        <br>

        <a href="admincomplaint.php" class="btn" style="color:white; background-color: #080202; width:200px; margin-left:350px;">Back</a>
        
        <br>

    </div>
</body>

</html>