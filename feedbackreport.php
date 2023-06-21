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

    <?php include "config/autoload.php"; ?>
    <?php include "components/navigation.php"; ?>

    <?php
    
    $type = $_REQUEST['type'] ? $_REQUEST['type'] : "user";
    $category = $_REQUEST['category'] ? $_REQUEST['category'] : "All";

    if (isset($_POST['user'])) {
        $type = "user";
    } else if (isset($_POST['expert'])) {
        $type = "expert";
    }

    $experience = new ExperienceController();

    $total_user = $experience->countUserIssueController();
    $total_expert = $experience->countExpertIssueController();
    $total = $total_user + $total_expert;

    $db_data = array();

    $user = NULL;
    $db_table = NULL;

    if (isset($_POST['bug'])) {
        $category = "Bug";
        $user = $experience->getUserBugIssueController($category, $type);
        $db_table = $experience->getUserDataController($category, $type);
    } else if (isset($_POST['feature'])) {
        $category = "Features";
        $user = $experience->getUserBugIssueController($category, $type);
        $db_table = $experience->getUserDataController($category, $type);
    } else if (isset($_POST['other'])) {
        $category = "Other";
        $user = $experience->getUserBugIssueController($category, $type);
        $db_table = $experience->getUserDataController($category, $type);
    } else {
        $category = "All";
        $user = $experience->getAllUserExperienceController($type);
        $db_table = $experience->getUserDataController($category, $type);
    }

    if ($user && $user->num_rows > 0) {
        while ($row = $user->fetch_assoc()) {
            $db_data[] = $row;
        }
    }

    ?>

    <div class="container" style="margin-top: 150px; margin-bottom: 100px">
        <h4 class="mb-3">
            <?php echo ($type == "user") ? "User" : "Expert"; ?> feedback report
        </h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Total issue</h5>
                                    <h1>
                                        <?php echo $total; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Users issue</h5>
                                    <h1>
                                        <?php echo $total_user; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Experts issue</h5>
                                    <h1>
                                        <?php echo $total_expert; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="row mt-5" action="" method="post">
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="hstack gap-2">
                                        <input type="hidden" name="type" value="<?php echo $type; ?>">
                                        <button class="btn btn-dark w-100" type="submit" name="user">
                                            Users
                                        </button>
                                        <button class="btn btn-dark w-100" type="submit" name="expert">
                                            Experts
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Issue Category
                                        (<?php echo $category; ?>)
                                    </h5>
                                    <div class="vstack gap-3">
                                        <input type="hidden" name="category" value="<?php echo $category; ?>">
                                        <button class="btn btn-outline-dark w-100" name="all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                <path
                                                    d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z" />
                                            </svg>
                                            All Category
                                        </button>
                                        <button class="btn btn-outline-dark w-100" name="bug">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bug-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956z" />
                                                <path
                                                    d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z" />
                                            </svg>
                                            Report a bug
                                        </button>
                                        <button class="btn btn-outline-dark w-100" name="feature">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                            </svg>
                                            Request a features
                                        </button>
                                        <button class="btn btn-outline-dark w-100" name="other">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                            </svg>
                                            Other
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <?php
                                    // Group the data by date
                                    $grouped_data = array();
                                    foreach ($db_data as $row) {
                                        $date = $row['submitDate'];
                                        if (!isset($grouped_data[$date])) {
                                            $grouped_data[$date] = 0;
                                        }
                                        $grouped_data[$date]++;
                                    }

                                    // Prepare the data for the chart
                                    $chart_data = array(
                                        'labels' => array_keys($grouped_data),
                                        'datasets' => array(
                                            array(
                                                'axis' => 'y',
                                                'label' => 'Reported issues',
                                                'data' => array_values($grouped_data),
                                                'fill' => false,
                                                'borderWidth' => 1
                                            )
                                        )
                                    );
                                    ?>

                                    <script>
                                        const data = <?php echo json_encode($chart_data); ?>;
                                        const ctx = document.getElementById('myChart');

                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: data,
                                            options: {
                                                indexAxis: 'y',
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Total issues reported (<?php echo ($type == "user") ? "User" : "Expert"; ?>)',
                                                        font: {
                                                            size: 16
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 0;

                                        if ($db_table && $db_table->num_rows > 0) {
                                            while ($row = $db_table->fetch_assoc()) {
                                                $index = $index + 1;
                                                echo '
                                                <tr>
                                                    <th scope="row">' . $index . '</th>
                                                    <td>' . (($type == "user")? $row['userFullName'] : $row['expertFullName']) . '</td>
                                                    <td>' . (($type == "user")? $row['userEmail']  : $row['expertEmail'] ). '</td>
                                                    <td>' . $row['issueDescription'] . '</td>
                                                </tr>
                                                ';
                                            }
                                        } else {
                                            echo '
                                            <tr>
                                                <th scope="row">N/A</th>
                                                <td>No Data Found!</td>
                                                <td>No Data Found!</td>
                                                <td>No Data Found!</td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>