<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <?php include "config/autoload.php"; ?>
    <?php include "components/navigation.php"; ?>

    <?php
    // Fetch user ratings using getUserSatisfy()
    $userRate = new ReportController();
    $userRatings = $userRate->getUserRating();

    // Fetch expert ratings using getExpertRating()
    $expertRate = new ReportController();
    $expertRatings = $expertRate->getExpertRating();

    // Function to determine the star rating based on the scale
    function getStarRating($scale)
    {
        switch ($scale) {
            case 'Very Bad':
                return 1;
            case 'Bad':
                return 2;
            case 'Neutral':
                return 3;
            case 'Good':
                return 4;
            case 'Very Good':
                return 5;
            default:
                return 0;
        }
    }

    // Array to store the counts of each scale for user ratings
    $userScaleCounts = array(
        'Very Good' => 0,
        'Good' => 0,
        'Neutral' => 0,
        'Bad' => 0,
        'Very Bad' => 0
    );

    // Retrieve and calculate the counts of each scale for user ratings
    $userTotalRatings = 0;
    while ($userRow = mysqli_fetch_assoc($userRatings)) {
        $userScale = $userRow['scale'];
        $userRating = getStarRating($userScale);
        $userScaleCounts[$userScale]++;
        $userTotalRatings++;
    }

    // Array to store the counts of each scale for expert ratings
    $expertScaleCounts = array(
        'Very Good' => 0,
        'Good' => 0,
        'Neutral' => 0,
        'Bad' => 0,
        'Very Bad' => 0
    );

    // Retrieve and calculate the counts of each scale for expert ratings
    $expertTotalRatings = 0;
    while ($expertRow = mysqli_fetch_assoc($expertRatings)) {
        $expertScale = $expertRow['scale'];
        $expertRating = getStarRating($expertScale);
        $expertScaleCounts[$expertScale]++;
        $expertTotalRatings++;
    }

    $totalRatings = $userTotalRatings + $expertTotalRatings;
    ?>
    <div class="container" style="margin-top: 150px; margin-bottom: 100px; width: 900px;">
        <h4 class="mb-3">
            Satisfication Report
        </h4>
        <div style="display: flex; justify-content: center">
            <div class="hstack gap-5">
                <div style="text-align: center;">
                    <h1 style="font-size: 64px;">
                        <?php echo $totalRatings ?>.0
                    </h1>
                    Rating
                </div>
                <div class="vstack gap-0" style="width: 150px;">
                    <?php
                    // Iterate over the sorted user ratings and display the star rating and progress bar
                    foreach ($userScaleCounts as $scale => $count) {
                        $rating = getStarRating($scale);
                        $userPercentage = ($count / $userTotalRatings) * 100;
                        $expertCount = $expertScaleCounts[$scale];
                        $expertPercentage = ($expertCount / $expertTotalRatings) * 100;
                        $eachRate = $count + $expertCount;
                        $totalPercentage = ($eachRate / $totalRatings) * 100;
                        ?>
                        <div>
                            <?php echo $rating; ?>
                            <i class="fa fa-star"></i>
                            (
                            <?php echo $eachRate ?>)
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalPercentage; ?>"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="width: <?php echo $totalPercentage; ?>%; background-color: #212529;"></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Make search input here -->
        <div style="width: 400px; padding-top: 40px; padding-bottom: 3px;" class="row">
            <div class="col-10">
                <form action="" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Search keyword">
                        <button type="submit" class="btn" style="background: #212529; color: white;">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-2" style="padding-top: 5px">
                <a href="/FK-EDUSEARCH/satisfyReport.php" type="button" style="color: #212529;">
                    <i class="fa fa-refresh"></i>
                </a>
            </div>
        </div>

        <hr>
        
        <?php

        // Retrieve the search keyword from the GET request
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        // Retrieve user experiences matching the search keyword
        $userExp = $userRate->searchUserExp($keyword);

        // Retrieve expert experiences matching the search keyword
        $expertExp = $expertRate->searchExpertExp($keyword);

        // Combine user and expert experiences into a single result set
        $combinedExp = array();

        // Add user experiences to the combined result set
        while ($userRow = mysqli_fetch_assoc($userExp)) {
            $combinedExp[] = array(
                'username' => $userRow['username'],
                'scale' => $userRow['scale'],
                'description' => $userRow['description'],
                'recommend' => $userRow['recommend'],
                'submitDate' => $userRow['submitDate'],
                'isUser' => true
            );
        }

        // Add expert experiences to the combined result set
        while ($expertRow = mysqli_fetch_assoc($expertExp)) {
            $combinedExp[] = array(
                'username' => $expertRow['expertUsername'],
                'scale' => $expertRow['scale'],
                'description' => $expertRow['description'],
                'recommend' => $expertRow['recommend'],
                'submitDate' => $expertRow['submitDate'],
                'isUser' => false
            );
        }

        // Sort the combined result set by submitDate in descending order
        usort($combinedExp, function ($a, $b) {
            return strtotime($b['submitDate']) - strtotime($a['submitDate']);
        });
        ?>

        <!-- Display combined user and expert experiences -->
        <?php foreach ($combinedExp as $exp): ?>
            <div class="row">
                <div class="col-3">
                    <strong>
                        <?php echo $exp['username']; ?>
                    </strong>
                </div>
                <div class="col-7">
                    <div class="vstack gap-2">
                        <div>
                            <h4>
                                <strong>
                                    <?php echo $exp['scale']; ?> !
                                </strong>
                            </h4>
                        </div>
                        <div>
                            <p>
                                <?php echo $exp['description']; ?>
                            </p>
                        </div>
                        <div>
                            <p style="font-size: 12px; margin-bottom: 0px">
                                <strong>Is it recommended? </strong>
                                <?php echo $exp['recommend']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <p style="font-size: 10px; color: #9f9e9e; text-align: right">
                        <?php echo $exp['submitDate']; ?>
                    </p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

    </div>
</body>

</html>