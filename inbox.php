<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <?php include "config/autoload.php"; ?>
    <?php include "components/navigation.php"; ?>

    <?php
    $user_data = json_decode($_COOKIE['user_data'], true);
    $expertid = $user_data['uid'];

    $expertPost = new PostController();
    $result = $expertPost->getPostByExpertIdController($expertid);

    echo'
    <div class="container" style="margin-top: 150px; padding-left: 200px; padding-right: 200px;">
        <div class=" card py-3 px-3">
            <div class="card-body">
                <div class="hstack gap-3">
                    <h3>Inbox</h3>
                </div>';

    if ($result && $result->num_rows > 0){
        while ($row = $result->fetch_assoc()){

            $inbox_db_fullname;

            $user = new UserController();

            $db_user = $user->getUserById($row['userid']);

            if ($db_user && $db_user->num_rows > 0) {
                while ($row_user = $db_user->fetch_assoc()) {
                    $inbox_db_fullname = $row_user['userFullName'];
                }
            }
            echo'
            <div class="card mt-5 py-3">
                <div class="card-body">
                    <div class="d-flex w-100">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                        <div class="row">
                            <h6 class="inline my-0">'.$inbox_db_fullname.'</h6>
                            <p><u>'.$row['postCategory'].'</u></p>
                            <div class="me-2 d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                    class="bi bi-reply" viewBox="0 0 16 16">
                                    <path
                                        d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                                </svg>
                                <p class="ms-2 text-body-secondary"><i>Answered to your <a class="link-opacity-100"
                                            href="#">discussion</a> on May 17</i></p>
                            </div>

                            <div class="mt-2">
                                <h6>'.$row['postTopic'].'</h6>
                                <p>'.$row['postContent'].'<a href="ms-1 text-body-secondary">(See
                                        more)</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
            echo'
            </div>
        </div>
    </div>
    ';
    ?>

</body>

</html>