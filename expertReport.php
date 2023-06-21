<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Research</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
</head>

<body>
    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php"; ?>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mt-7">Publication Reports</h3>
            <div class="card">
                <div class="card-body">
                    <canvas id="publication_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Research Reports</h3>
                <div class="card">
                    <div class="card-body">
                        <canvas id="research_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

    <?php
    $publicationController = new PublicationController();
    $researchController = new ResearchController();

    $userdata = json_decode($_COOKIE['user_data'], true);
    $cookie_userid = $userdata['uid'];

    // Get publication data
    $publications = $publicationController->getPublicationCotroller($cookie_userid);

    $publicationCategories = array();
    foreach ($publications as $publication) {
        $category = $publication['publicationCategory'];
        if (!isset($publicationCategories[$category])) {
            $publicationCategories[$category] = 1;
        } else {
            $publicationCategories[$category]++;
        }
    }

    $publicationData = array();
    $publicationLabels = array();
    $publicationBackgroundColor = array();
    $i = 0;

    $publicationColors = array("#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#6f42c1", "#fd7e14", "#fdcc00", "#00b6cb");

    foreach ($publicationCategories as $category => $count) {
        $publicationLabels[] = $category;
        $publicationData[] = $count;
        $publicationBackgroundColor[] = $publicationColors[$i % count($publicationColors)];
        $i++;
    }

    // Get research data
    $researches = $researchController->getResearchController($cookie_userid);

    $researchStatuses = array();
    foreach ($researches as $research) {
        $status = $research['researchStatus'];
        if (!isset($researchStatuses[$status])) {
            $researchStatuses[$status] = 1;
        } else {
            $researchStatuses[$status]++;
        }
    }

    $researchData = array();
    $researchLabels = array();
    $researchBackgroundColor = array();
    $i = 0;

    $researchColors = array("#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#6f42c1", "#fd7e14", "#fdcc00", "#00b6cb");

    foreach ($researchStatuses as $status => $count) {
        $researchLabels[] = $status;
        $researchData[] = $count;
        $researchBackgroundColor[] = $researchColors[$i % count($researchColors)];
        $i++;
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var publicationData = {
                labels: <?php echo json_encode($publicationLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($publicationData); ?>,
                    backgroundColor: <?php echo json_encode($publicationBackgroundColor); ?>,
                    label: "Publication Category"
                }]
            };

            var researchData = {
                labels: <?php echo json_encode($researchLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($researchData); ?>,
                    backgroundColor: <?php echo json_encode($researchBackgroundColor); ?>,
                    label: "Research Status"
                }]
            };

            var options = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 65
            };

            Chart.defaults.color = "#FFF";

            new Chart(document.getElementById("publication_chart").getContext("2d"), {
                type: "pie",
                data: publicationData,
                options: options
            });

            new Chart(document.getElementById("research_chart").getContext("2d"), {
                type: "pie",
                data: researchData,
                options: options
            });
        });
    </script>
</body>

</html>
