<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php

    session_start();

    $_SESSION['logged_out'];

    if ($_SESSION['logged_out'] == true) {
        header("Location: index.php");
    }
    ?>

    <?php include "components/navigation.php"; ?>

    <div class="d-flex justify-content-center pt-5">
        <div class="mt-5" style="width: 40%">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card mt-3" style="width: 40%">
            <div class="card-body">
                <div class="d-flex">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                        class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
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
                                    <p>This is the expert's answer to the question. Laravel is considered one of the
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
                                                    placeholder="name@example.com">
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
                                                <option value="1">Unsatisfied Expert's Feedback</option>
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
                                    <p>I agree with John. Laravel's features like...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="new-post position-absolute top-0 end-0 w-25 pt-5 me-5">
        <div class="card mt-5">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">New Post</h5>
                </div>
                <div class="d-flex">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                        class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                    <div class="row mb-3">
                        <small><b>AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA</b></small>
                    </div>
                </div>
                <form>
                    <div class="dropdown mb-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle">
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea class="form-control" id="postContent" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control form-control-sm" type="file" id="formFile">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>