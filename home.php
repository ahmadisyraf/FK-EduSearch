<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php

    session_start();

    $_COOKIE['user_data'];
    $user_cookie = json_decode($_COOKIE['user_data'], true);

    $likedPosts = $_SESSION['liked_posts'][$user_cookie['uid']] ?? [];

    error_reporting(0);

    include "config/autoload.php";

    $show_error;
    $show_message;
    $show_success;

    if (isset($_POST['submit'])) {

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

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    ?>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex justify-content-center pt-5">
        <div class="mt-5" style="width: 40%">
            <form class="d-flex" action="home.php" method="post" role="search">
                <div class="input-group me-2">
                    <input class="form-control" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button type="submit" name="submitsearch" class="btn btn-secondary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="dropdown">
                    <select class="form-select" name="category" aria-label="Default select example">
                        <option selected>Category</option>
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Graphic and Multimedia">Graphic and Multimedia</option>
                        <option value="Networking">Networking</option>
                    </select>
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

    $result;
    $post = new PostController();

    if (isset($_POST['submitsearch'])) {

        $search = $_REQUEST['search'];
        $category = $_REQUEST['category'];

        $searchController = new PostController();
        $result = $searchController->searchPostController($search, $category);
    } else {
        $result = $post->getAllPostController();
    }

    if (isset($_POST['commentsubmit'])) {

        $postid = $_REQUEST['postid'];
        $comment = $_REQUEST['comment'];
        $uid = $user_cookie['uid'];

        $commentController = new CommentController();
        $resultComment = $commentController->insertCommentController($uid, $postid, $comment);

        if (!$resultComment) {
            $show_error = true;
            $show_message = "Failed to comment";
        } else {
            $show_success = true;
            $show_message = "Yeay! your post already comment.";
        }
    }

    if (isset($_POST['like'])) {
        $uid = $user_cookie['uid']; 
        $postid = $_POST['postid']; // Use $_POST instead of $_REQUEST
    
        $likeController = new LikeController();
        $existingLikeResult = $likeController->existingLikeController($uid, $postid);
    
        if ($existingLikeResult && $existingLikeResult->num_rows > 0) {
            $existingLike = $existingLikeResult->fetch_assoc();
            $resultUnlike = $likeController->unlikeController($existingLike['likeid']);
            if (($key = array_search($postid, $likedPosts)) !== false) {
                unset($likedPosts[$key]); // Remove post ID from liked posts array
            }
        } else {
            $resultLike = $likeController->likeController($uid, $postid);
            $likedPosts[] = $postid; // Add post ID to liked posts array
        }
    
        $_SESSION['liked_posts'][$uid] = $likedPosts; // Store liked posts array for the current user
    }

    if (isset($_POST['rate'])) {
        $userid = $user_cookie['uid'];
        $replyid = $_REQUEST['replyid'];
        $rate = $_REQUEST['statisfy'];

        $insertRate = $post->insertRatingController($userid, $replyid, $rate);

        if ($insertRate == false) {
            $show_error = true;
        } else {
            $show_success = true;
        }
    }

    function getStarRate($scale)
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


    if ($result && $result->num_rows > 0) {
        while ($post_row = $result->fetch_assoc()) {
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
                <div class="card mt-3" style="width: 40%; margin-bottom: 30px">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                            <div class="row">
                                <h6 class="inline my-0">' . $post_db_fullname . '</h6>
                                <p><u>' . $post_row['postCategory'] . '</u>. Posted on ' . date("F d", strtotime($post_row['postDate'])) . '</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="my-0"><b>' . $post_row['postTopic'] . '</b></p>
                            <p>' . $post_row['postContent'] . '</p>

                            <img class="img-fluid" src="data:image;base64,' . base64_encode($post_row['image']) . '" alt="Image" />
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-start">
                                <form action="home.php" method="POST" class="d-inline">
                                    <input type="hidden" name="postid" value="' . $post_row['postid'] . '">
                                    <button class="btn btn-icon btn-transparent btn-like" name="like" type="submit">
                                        <i class="bi '.(in_array($post_row['postid'], $likedPosts) ? 'bi-heart-fill' : 'bi-heart').'"></i>
                                    </button>
                                </form>
                                <button class="btn btn-icon btn-transparent btn-comment" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#commentSection-' . $post_row['postid'] . '" aria-expanded="false" aria-controls="commentSection">
                                    <i class="bi bi-chat"></i>
                                </button>
                            </div>
                        </div>';

                        $reply = new ReplyController();
            
                        $allReply = $reply->getRepliesByPostIdController($post_row['postid']);
            
                        if ($allReply && $allReply->num_rows > 0) {
                            $row_reply = $allReply->fetch_assoc();

                            echo'
                            <div class="mt-3">
                                <h6>Expert Answer</h6>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                            <div>
                                                <div class="row">
                                                    <h6 class="inline my-0">'.$row_reply['expertFullName'].'</h6>
                                                    <p><u>'.$row_reply['postCategory'].'</u>. Answer on ' . date("F d", strtotime($row_reply['replyDate'])) . '</p>
                                                </div>
                                                    <p>'.$row_reply['reply'].'</p>
                                            </div>
                                        </div>
                                        <a href="addcomplaint.php?postid=' . $post_row['postid'] . '">
                                        <button class="btn btn-icon btn-transparent btn-report position-absolute top-0 end-0"
                                            data-bs-target="#exampleModal" data-bs-toggle="modal" type="button" href="addcomplaint.php">
                                            <i class="bi bi-exclamation-circle"></i>
                                        </button></a>';

                                            $replyRatings = $post->getRateController($row_reply['replyid']);

                                            // Array to store the counts of each scale for reply ratings
                                            $replyScaleCounts = array(
                                                'Very Good' => 0,
                                                'Good' => 0,
                                                'Neutral' => 0,
                                                'Bad' => 0,
                                                'Very Bad' => 0
                                            );

                                            // Retrieve and calculate the counts of each scale for reply ratings
                                            $replyTotalRatings = 0;
                                            while ($replyRow = mysqli_fetch_assoc($replyRatings)) {
                                                $replyScale = $replyRow['rating'];
                                                $replyRating = getStarRate($replyScale);
                                                $replyScaleCounts[$replyScale]++;
                                                $replyTotalRatings++;
                                            }
                                            

                                            // Calculate the reply rate
                                            $replyRate = 0;
                                            if ($replyTotalRatings > 0) {
                                                $replyRate = ($replyScaleCounts['Very Good'] * 5 +
                                                    $replyScaleCounts['Good'] * 4 +
                                                    $replyScaleCounts['Neutral'] * 3 +
                                                    $replyScaleCounts['Bad'] * 2 +
                                                    $replyScaleCounts['Very Bad']) / $replyTotalRatings;
                                            }

                                            $overallRating = round($replyRate, 2);

                                        echo '
                                        <div class="rating-stars position-absolute top-0 end-0 pt-3 mt-4 me-2">
                                            <i class="bi bi-star-fill"></i>
                                            ' . $overallRating . '
                                        </div>

                                        <form class="mt-3" action="" method="post">
                                            <input type="hidden" name="replyid" value="' . $row_reply['replyid'] . '">
                                            <div class="hstack gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault1"
                                                        value="Very Bad" ' . ($replyRating === 1 ? 'checked' : '') . '>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Very Bad
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault1" value="Bad"
                                                        ' . ($replyRating === 2 ? 'checked' : '') . '>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Bad
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                                                        value="Neutral" ' . ($replyRating === 3 ? 'checked' : '') . '>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Neutral
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                                                        value="Good" ' . ($replyRating === 4 ? 'checked' : '') . '>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Good
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statisfy" id="flexRadioDefault2"
                                                        value="Very Good" ' . ($replyRating === 5 ? 'checked' : '') . '>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Very Good
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="btn btn-dark mt-3" type="submit" name="rate">
                                                Send feedback
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }

                        echo'
                        <div class="mt-3 collapse" id="commentSection-' . $post_row['postid'] . '">
                            <h6>Comments</h6>
                            <div class="mt-3">
                                <form action="" method="POST">
                                    <input type="hidden" name="postid" value="' . $post_row['postid'] . '">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="comment" placeholder="Add a comment...">
                                        <button type="submit" name="commentsubmit" class="btn btn-primary">
                                            <i class="bi bi-chevron-right"></i> <!-- Replace with your desired icon class -->
                                        </button>                        
                                    </div>
                                </form>
                            </div>';

            $commentController = new CommentController();
            $comments = $commentController->getCommenntByPostIdController($post_row['postid']);

            if ($comments && $comments->num_rows > 0) {
                while ($comment_row = $comments->fetch_assoc()) {

                    $comment_db_fullname;

                    $db_user = $user->getUserById($comment_row['userid']);

                    if ($db_user && $db_user->num_rows > 0) {
                        while ($row_user = $db_user->fetch_assoc()) {
                            $comment_db_fullname = $row_user['userFullName'];
                        }
                    }
                    echo '
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                        <div>
                                            <p class="my-0"><b>' . $comment_db_fullname . '</b></p>
                                            <p class="mt-1">' . $comment_row['comment'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            }
            echo '    
                        </div>
                    </div>
                </div>  
            </div>
            ';
        }
    } else {
        if ($result && $result->num_rows > 0) {
            while ($search_row = $result->fetch_assoc()) {
                $post_db_fullname;

                $user = new UserController();
                $db_user = $user->getUserById($search_row['userid']);

                if ($db_user && $db_user->num_rows > 0) {
                    while ($row_user = $db_user->fetch_assoc()) {
                        $post_db_fullname = $row_user['userFullName'];
                    }
                }
                echo '
                <div class="d-flex justify-content-center ">
                    <div class="card mt-3" style="width: 40%; margin-bottom: 30px">
                        <div class="card-body">
                            <div class="d-flex">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                                <div class="row">
                                    <h6 class="inline my-0">' . $post_db_fullname . '</h6>
                                    <p><u>' . $search_row['postCategory'] . '</u>. Posted on ' . date("F d", strtotime($search_row['postDate'])) . '</p>
                                </div>
                                ' . $search_row['postid'] . '
                            </div>
                            <div class="mt-2">
                                <p class="my-0"><b>' . $search_row['postTopic'] . '</b></p>
                                <p>' . $search_row['postContent'] . '</p>
    
                                <img class="img-fluid" src="data:image;base64,' . base64_encode($search_row['image']) . '" alt="Image" />
                            </div>
    
                            <div class="mt-3">
                                <div class="d-flex justify-content-start">
                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="postid" value="' . $search_row['postid'] . '">
                                        <button class="btn btn-icon btn-transparent btn-like" name="like" type="submit">

                                            <i class="bi '.(in_array($post_row['postid'], $likedPosts) ? 'bi-heart-fill' : 'bi-heart').'"></i>

                                        </button>
                                    </form>
                                    <button class="btn btn-icon btn-transparent btn-comment" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#commentSection-' . $search_row['postid'] . '" aria-expanded="false" aria-controls="commentSection">
                                        <i class="bi bi-chat"></i>
                                    </button>
                                </div>
                            </div>
    
                            <div class="mt-3">
                                <h6>Expert Answer</h6>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                            <div>
                                                <div class="row">
                                                    <h6 class="inline my-0">Expert Name</h6>
                                                    <p><u>Software Engineering</u>. Answer on May 29</p>
                                                </div>
                                                <p>This is the experts answer to the question. Laravel is considered one of the
                                                    best PHP frameworks due to its robust features and ease of use. Some advantages
                                                    of Laravel include...</p>
                                            </div>
                                        </div>
                                        <a href="addcomplaint.php?postid=' . $search_row['postid'] . '">
                                        <button class="btn btn-icon btn-transparent btn-report position-absolute top-0 end-0"
                                            data-bs-target="#exampleModal" data-bs-toggle="modal" type="button" href="addcomplaint.php">
                                            <i class="bi bi-exclamation-circle"></i>
                                        </button></a>
    
                                        <div class="rating-stars position-absolute top-0 end-0 pt-3 mt-4 me-2">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-half text-warning"></i>
                                        </div>
                                        <button class="btn btn-outline-primary me-2" type="button">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                        </button>
                                        <button class="btn btn-outline-primary" type="button">
                                            <i class="bi bi-hand-thumbs-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
    
                            <div class="mt-3 collapse" id="commentSection-' . $search_row['postid'] . '">
                                <h6>Comments</h6>
                                <div class="mt-3">
                                    <form action="" method="POST">
                                        <input type="hidden" name="postid" value="' . $search_row['postid'] . '">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="comment" placeholder="Add a comment...">
                                            <button type="submit" name="commentsubmit" class="btn btn-primary">
                                                <i class="bi bi-chevron-right"></i> <!-- Replace with your desired icon class -->
                                            </button>                        
                                        </div>
                                    </form>
                                </div>';

                $commentController = new CommentController();
                $comments = $commentController->getCommenntByPostIdController($search_row['postid']);

                if ($comments && $comments->num_rows > 0) {
                    while ($comment_row = $comments->fetch_assoc()) {

                        $comment_db_fullname;

                        $db_user = $user->getUserById($comment_row['userid']);

                        if ($db_user && $db_user->num_rows > 0) {
                            while ($row_user = $db_user->fetch_assoc()) {
                                $comment_db_fullname = $row_user['userFullName'];
                            }
                        }
                        echo '
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                            <div>
                                                <p class="my-0"><b>' . $comment_db_fullname . '</b></p>
                                                <p class="mt-1">' . $comment_row['comment'] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                }
                echo '    
                            </div>
                        </div>
                    </div>  
                </div>
                ';
            }
        } elseif ($result->num_rows < 0) {
            echo "Not found";
        } else {
            echo '
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <div class="alert alert-danger mt-3" style="width: 40%;" role="alert">
                            Opps! seems like there is an error
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
    ?>

    <div class="new-post position-absolute top-0 end-0 w-25 pt-5 me-5 animate__animated animate__slideInRight">
        <div class="card mt-5">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">New Post</h5>
                </div>
                <div class="d-flex">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                        class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                    <div class="row mb-3">
                        <small><b>
                                <?php echo $user_cookie['fullname']; ?>
                            </b></small>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            <option selected>Choose Category</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Graphic and Multimedia">Graphic and Multimedia</option>
                            <option value="Networking">Networking</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="topic" class="form-label">Title</label>
                        <input type="text" class="form-control" id="topic" name="topic">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control form-control-sm" type="file" id="formFile" name="image">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>