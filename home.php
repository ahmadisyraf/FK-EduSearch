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
        $resultcomplaint = $complaintController->insertComplaintController($userid, $complaintDate, $complaintType, $complaintDescription);

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
            if($show_success) {
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

    <!-- <div class="d-flex justify-content-center ">
        <div class="card mt-3" style="width: 40%; margin-bottom: 100px">
            <div class="card-body">
                <div class="d-flex">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                    <div class="row">
                        <h6 class="inline my-0">AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</h6>
                        <p><u>Software Engineering</u>. Posted on May 27</p>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="my-0"><b>Why are laravel better than other framework?</b></p>
                    <p>I want to create MVC framework for my SDW project by using Laravel. I want to know is Laravel is
                        better than other framework and what the advantages of Laravel.</p>

                    <img class="img-fluid" src="https://www.jesusamieiro.com/wp-content/uploads/2019/10/Laravel.png" />
                </div>

                <div class="mt-3">
                    <div class="d-flex justify-content-start">
                        <button class="btn btn-icon btn-transparent btn-like" type="button">
                            <i class="bi bi-heart"></i>
                        </button>
                        <button class="btn btn-icon btn-transparent btn-comment" type="button" data-bs-toggle="collapse" data-bs-target="#commentSection" aria-expanded="false" aria-controls="commentSection">
                            <i class="bi bi-chat"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-3">
                    <h6>Expert Answer</h6>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                <div>
                                    <div class="row">
                                        <h6 class="inline my-0">Expert Name</h6>
                                        <p><u>Software Engineering</u>. Answer on May 29</p>
                                    </div>
                                    <p>This is the expert's answer to the question. Laravel is considered one of the
                                        best PHP frameworks due to its robust features and ease of use. Some advantages
                                        of Laravel include...</p>
                                </div>
                            </div>
                            <button class="btn btn-icon btn-transparent btn-report position-absolute top-0 end-0" data-bs-target="#exampleModal" data-bs-toggle="modal" type="button">
                                <i class="bi bi-exclamation-circle"></i>
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Complaint</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="home.php" method="post"></form>
                                        <div class="modal-body">
                                            <form action="/action_page.php">
                                                <label for="example">Date</label>
                                                <input style="width:150px" type="datetime-local" id="complaintDate" name="complaintDate">
                                            </form>

                                            <br>
                                            <label for="exampleFormControlInput4" class="form-label d-flex">Complaint
                                                Type</label>
                                            <select class="form-select" aria-label="Default select example" name="complaintType" id="complaintType">
                                                <option selected>Open this select menu</option>
                                                <option value="Unsatisfied Expert's Feedback">Unsatisfied Expert's Feedback</option>
                                                <option value="Wrongly Assigned Research Area">Wrongly Assigned Research Area</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <br>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput2" class="form-label d-flex">Description</label>
                                                <input type="text" class="form-control" id="complaintDescription" name="complaintDecription" placeholder="....">
                                            </div>

                                            <br>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="home.php" style="color:white; background-color: #080202; width:100px" class="btn">Back</a>
                                            <a href="usercomplaint.php" style="color:white; background-color: #080202; width:160px" class="btn" name="addcomplaint">Add Complaint</a>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

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

                <div class="mt-3 collapse" id="commentSection">
                    <h6>Comments</h6>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                <div>
                                    <p class="my-0"><b>John Doe</b></p>
                                    <p>This is a great question. Laravel offers several advantages such as...</p>
                                    <button class="btn btn-sm btn-transparent btn-reply" type="button" data-bs-toggle="collapse" data-bs-target="#replySection-1" aria-expanded="false" aria-controls="replySection-1">
                                        <b>Reply 1></b>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="replySection-1">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                    <div>
                                        <p class="my-0"><b>Your Name</b></p>
                                        <p>Your reply to the comment goes here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                <div>
                                    <p class="my-0"><b>Jane Smith</b></p>
                                    <p>I agree with John. Laravel's features like...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div> -->

    <?php

    $post = new PostController();

    $get_all_post = $post->getAllPostController();

    if ($get_all_post && $get_all_post->num_rows > 0) {
        while ($post_row = $get_all_post->fetch_assoc()) {
            $post_db_fullname;

            $user = new UserController();

            $db_user = $user->getUserById($post_row['userid']);

            if($db_user && $db_user->num_rows > 0) {
                while($row_user = $db_user->fetch_assoc()) {
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
                                <p><u>'.$post_row['postCategory'].'</u>. Posted on '. date("F d", ($post_row['postDate'])).'</p>
                            </div>
                            '.$post_row['postid'].'
                        </div>
                        <div class="mt-2">
                            <p class="my-0"><b>' . $post_row['postTopic'] . '</b></p>
                            <p>'.$post_row['postContent'].'</p>

                            <img class="img-fluid" src="data:image;base64,'.base64_encode($post_row['image']).'" alt="Image" />
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-start">
                                <button class="btn btn-icon btn-transparent btn-like" type="button">
                                    <i class="bi bi-heart"></i>
                                </button>
                                <button class="btn btn-icon btn-transparent btn-comment" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#commentSection" aria-expanded="false" aria-controls="commentSection">
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
                                    <button class="btn btn-icon btn-transparent btn-report position-absolute top-0 end-0"
                                        data-bs-target="#exampleModal" data-bs-toggle="modal" type="button">
                                        <i class="bi bi-exclamation-circle"></i>
                                    </button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Complaint</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label d-flex">Email
                                                            address</label>
                                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                                            placeholder="'.$row_user['postid'].'" value="'.$post_row['postid'].'">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput2"
                                                            class="form-label d-flex">Description</label>
                                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                                            placeholder="....">
                                                    </div>
                                                    <label for="exampleFormControlInput4" class="form-label d-flex">Complaint
                                                        Type</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">Unsatisfied Experts Feedback</option>
                                                        <option value="2">Wrongly Assigned Research Area</option>
                                                        <option value="3">Other</option>
                                                    </select>
                                                    <br>
                                                    <form action="/action_page.php">
                                                        <label style="" ; for="example">Date</label>
                                                        <input style="width:150px" type="datetime-local" id="birthdaytime"
                                                            name="birthdaytime">
                                                    </form>
                                                    <br>
                                                    <form action="/action_page.php">
                                                        <label for="appt">Select a time:</label>
                                                        <input type="time" id="appt" name="appt">
                                                    </form>
                                                    '.$post_row['postid'].'
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" style="color:white; background-color: #080202; width:100px"
                                                        class="btn">Back</a>
                                                    <a href="#" style="color:white; background-color: #080202; width:160px"
                                                        class="btn">Add Complaint</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                        <div class="mt-3 collapse" id="commentSection">
                            <h6>Comments</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                        <div>
                                            <p class="my-0"><b>John Doe</b></p>
                                            <p>This is a great question. Laravel offers several advantages such as...</p>
                                            <button class="btn btn-sm btn-transparent btn-reply" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#replySection-1" aria-expanded="false"
                                                aria-controls="replySection-1">
                                                <b>Reply 1></b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="replySection-1">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                                class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                            <div>
                                                <p class="my-0"><b>Your Name</b></p>
                                                <p>Your reply to the comment goes here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            class="rounded-circle me-3" style="width: 30px; height: 30px;" alt="Avatar" />
                                        <div>
                                            <p class="my-0"><b>Jane Smith</b></p>
                                            <p>I agree with John. Laravels features like...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                    <div class="row mb-3">
                        <small><b>
                                <?php echo $user_cookie['fullname']; ?>
                            </b></small>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data" >
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