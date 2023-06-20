<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "config/autoload.php"; ?>
    <?php include "components/navigation.php"; ?>

    <?php

    $userdata = json_decode($_COOKIE['user_data'], true);

    $experience = new ExperienceController();

    $show_error = false;
    $show_success = false;

    if (isset($_POST['submit'])) {
        $uid = $userdata['uid'];

        $scale = $_REQUEST['statisfy'];
        $description = $_REQUEST['description'];
        $recommend = $_REQUEST['recommend'];
        $issueCategory = $_REQUEST['issueCategory'];
        $issue = $_REQUEST['issues'];
        $role = $_SESSION['role'];

        $insert = $experience->insertExperienceController($role, $uid, $scale, $description, $recommend, $issueCategory, $issue);

        if ($insert == false) {
            $show_error = true;
        } else {
            $show_success = true;
        }
    }

    ?>

    <div class="container" style="margin-top: 150px; width: 600px">
        <h3 class="mb-3">Give us your feedback</h3>
        <?php
        if ($show_success) {
            echo '
            <div id="alert" class="alert alert-success" role="alert">
                Thank you! we will try to improve our system.
            </div>
            ';
        } else if ($show_error) {
            echo '
            <div id="alert" class="alert alert-danger" role="alert">
                Oops! seems like there is an error.
            </div>
            ';     
        }
        ?>
        <script type="text/javascript">
            // Closing the alert after 3 seconds
            setTimeout(function () {
                var alertElement = document.getElementById('alert');
                if (alertElement) {
                    alertElement.remove();
                }
            }, 2000);
        </script>
        <form action="" method="post" class="card animate__animated animate__zoomIn animate__faster">
            <div class="card-body">
                <h5 class="mt-3 mb-3">Are you statisfied with FK-EduSearch?</h5>
                <div class="hstack gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault1"
                            value="Very Bad">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Very Bad
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault1" value="Bad">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Bad
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                            value="Neutral">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Neutral
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                            value="Good">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Good
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                            value="Very Good">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Very Good
                        </label>
                    </div>
                </div>
                <div class="mb-3 mt-5">
                    <h5 class="mt-3 mb-3">Describe your experience to us!</h5>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Describe your experience" name="description"></textarea>
                </div>
                <h5 class="mt-5 mb-3">Would you recommend FK-EduSearch to your friend?</h5>
                <div class="hstack gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recommend" id="flexRadioDefault1"
                            value="Never">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Never
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recommend" id="flexRadioDefault1"
                            value="Probably Not">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Probably Not
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recommend" id="flexRadioDefault2"
                            value="Never">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Maybe
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recommend" id="flexRadioDefault2"
                            value="Sure">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Sure
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recommend" id="flexRadioDefault2"
                            value="Yes">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Yes
                        </label>
                    </div>
                </div>
                <h5 class="mt-5 mb-3">Tell us any related about FK-EduSearch(optional)</h5>
                <div class="hstack gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="issueCategory" id="flexRadioDefault1"
                            value="Bug">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Report a Bug
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="issueCategory" id="flexRadioDefault1"
                            value="Features">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Request for a features
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="issueCategory" id="flexRadioDefault1"
                            value="Other">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Other
                        </label>
                    </div>
                </div>
                <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Describe your experience" name="issues"></textarea>
                <div class="mt-4 mb-3">
                    <button class="btn btn-dark" type="submit" name="submit">
                        Send feedback
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>