<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php

    session_start();

    include "config/autoload.php";

    $show_error = '';
    $show_message = '';
    $show_success = '';

    $_COOKIE['user_data'];
    $user_cookie = json_decode($_COOKIE['user_data'], true);

    if (isset($_POST['hantar'])) {

        $uid = $user_cookie['uid'];
        $topic = $_REQUEST['topic'];
        $content = $_REQUEST['content'];
        $category = $_REQUEST['category'];

        if (isset($_FILES['image']['tmp_name'])) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        }

        if (!$topic || !$content || !$category) {
            $show_error = true;
            $show_message = "Please fill all fields";
        } else {
            $postController = new PostController();
            $result = $postController->insertPostController($uid, $topic, $content, $category, $image);

            if (!$result) {
                $show_error = true;
                $show_message = "Failed to insert post data";
            } else {
                $show_success = true;
                $show_message = "Yeay! your post already been publish.";
            }
        }
    }


    if (isset($_POST['submitReply'])) {

        // Get the values from the form
        $reply = $_POST['reply'];
        $postId = $_POST['post_id'];
        $uid = $user_cookie['uid']; // Updated variable name

        // Insert the publication
        $replyController = new ReplyController();
        $insert = $replyController->insertReplyController($uid, $postId, $reply);

        // Check if the insert was successful
        if (!$insert) {
            $error = true;
        } else {
            $success = true;
            echo '<script>
                    
                      setTimeout(function() {
                          window.location.href = "experthome.php";
                      }, 2000); // Redirect after 2 seconds
                  </script>';
        }
    }

    if (isset($_POST['deleteReply'])) {
    $replyId = $_POST['reply_id'];
    
    $replyController = new ReplyController();
    $delete = $replyController->deleteReplyByReplyIdController($replyId);
    
    if ($delete) {
        // Redirect to refresh the page after deleting the reply
        header("Location: experthome.php");
        exit;
    } else {
        $show_error = true;
        $show_message = "Failed to delete reply";
    }
}


    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    if (isset($_POST['addcomplaint'])) {
        $_COOKIE['user_data'];
        $user_cookie = json_decode($_COOKIE['user_data'], true);

        $userid = $user_cookie['userid'];
        $complaintDate = $_REQUEST['complaintDate'];
        $complaintType = $_REQUEST['complaintType'];
        $complaintDescription = $_REQUEST['complaintDescription'];

        $complaintController = new complaintController();
        // $resultcomplaint = $complaintController->insertComplaintController($userid, $complaintDate, $complaintType, $complaintDescription);

        if (!$resultcomplaint) {
            $show_error = true;
            $show_message = "Failed to insert post data";
        } else {
            $show_success = true;
        }
    }

    ?>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex justify-content-center pt-5">
        <div class="mt-5" style="width: 40%">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </form>
            <?php
            if ($show_success) {
                if ($show_success == true) {
                    echo '
                        <div class="alert alert-success mt-3" role="alert">
                            ' . $show_message . '
                        </div>
                        ';
                }
            }
            ?>
        </div>
    </div>

    <?php

    $post = new PostController();

    $get_all_post = $post->getAllPostController();

    if ($get_all_post && $get_all_post->num_rows > 0) {
        while ($post_row = $get_all_post->fetch_assoc()) {
            $post_db_fullname;

            $user = new UserController();

            $db_user = $user->getUserById($post_row['userid']);

            if ($db_user && $db_user->num_rows > 0) {
                while ($row_user = $db_user->fetch_assoc()) {
                    $post_db_fullname = $row_user['userFullName'];
                }
            }
            echo '
                <div class="d-flex justify-content-center ">
                <div class="card mt-3" style="width: 700px; margin-bottom: 30px">
                    <div class="card-body">
                        <div class="d-flex">
                        <input type="hidden" name="post_id" value="' . $post_row['postid'] . '">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                            <div class="row">
                                <h6 class="inline my-0">' . $post_db_fullname . '</h6>
                                <p><u>' . $post_row['postCategory'] . '</u>. Posted on ' . date("F d", strtotime($post_row['postDate'])) . '</p>

                            </div>
                            ' . $post_row['postid'] . '
                        </div>
                        <div class="mt-2">
                            <p class="my-0"><b>' . $post_row['postTopic'] . '</b></p>
                            <p>' . $post_row['postContent'] . '</p>

                            <img class="img-fluid" src="data:image;base64,' . base64_encode($post_row['image']) . '" alt="Image" />
                        </div>';


            $replyController = new ReplyController();
            $replies = $replyController->getRepliesByPostIdController($post_row['postid']);

            if ($replies && $replies->num_rows > 0) {
                while ($reply_row = $replies->fetch_assoc()) {
                    echo '
                        <div class="mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                                        <div>
                                            <h6 class="inline my-0">' . $reply_row['expertFullName'] . '</h6>
                                        </div>
                                        <div>
                                            <form method="post" action="">
                                            <input type="hidden" name="reply_id" value="' . $reply_row['replyid'] . '">

                                                <button type="submit" name="deleteReply" class="btn btn-danger btn-sm position-absolute bottom-0 end-0"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p>' . $reply_row['reply'] . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }





            echo '
                        <div class="mt-3">
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Reply</label>
        <form method="post" action="">
            <textarea class="form-control" name="reply" rows="3"></textarea>
            <input type="hidden" name="post_id" value="' . $post_row['postid'] . '">
            <button type="submit" name="submitReply" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
';
        }
    }

    
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-J5V0bQv3HuwYF/rB+J1CkGZr5w9vrYssmWnqPyKbpl8vE3USxbHcRmXYr+5gTJOj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-saOYK+87AQR4FuMFRm3fjI6WPOp1gMUGeK+k5GTH2DbUcOUEwCD8N/XeWq/2wtDI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>