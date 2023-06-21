<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php include "components/navigation.php"; ?>
    <?php include "config/autoload.php";
    error_reporting(0);

        $getPost = new PostController();

        $user_data = json_decode($_COOKIE['user_data'], true);
        $userId = $user_data['uid'];

        $postID;
        $postTopic;
        $postDate;
        $postStatus;
        $show_error;
        $show_success;
        $show_message;


        $allPost = $getPost->getAllPostController();

    ?>

<div class="container py-4">
        <h4 class="mt-5"><img style="width:150px; height:150px" class="rounded-circle mt-3 me-2" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" height="30"><?php echo''.$user_data['fullname'].''?></h4>
        <?php
        if($show_success) {
            if ($show_success == true) {
            echo '
                <div class="alert alert-danger mt-3" role="alert">
                    ' . $show_message . '
                </div>
                ';
            }
        }
        if($show_success_update) {
            if ($show_success_update == true) {
            echo '
                <div class="alert alert-success mt-3" role="alert">
                    ' . $show_message_update . '
                </div>
                ';
            }
        }
        if($show_error) {
            if ($show_error == true) {
            echo '
                <div class="alert alert-danger mt-3" role="alert">
                    ' . $show_message_update . '
                </div>
                ';
            }
        }
        ?>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" data-bs-toggle="tab" href="#allPost"> All Posts</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="allPost" class="tab-pane fade show active">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:200px;">No.</th>
                                    <th style="width:600px;">Post Title</th>
                                    <th style="width:600px;">Post Category</th>
                                    <th style="width:400px">Date</th>
                                    <th style="width:150px">Status</th>
                                    <th style="width:50px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($allPost) {
                                    if ($allPost->num_rows > 0) {
                                        $counter = 1;
                                        while ($row = $allPost->fetch_assoc()) {
                                            $postID = $row['postid'];
                                            $postTopic = $row['postTopic'];
                                            $postContent = $row['postContent'];
                                            $postCategory = $row['postCategory'];
                                            $image = $row['image'];
                                            $postDate = $row['postDate'];
                                            $postStatus = $row['postStatus'];
                                
                                            echo '
                                            <tr>
                                                <td>'.$counter.'</td>
                                                <td>'.$postTopic.'</td>
                                                <td>'.$postCategory.'</td>
                                                <td>'. date("F d", strtotime($row['postDate'])).'</td>
                                                <td>
                                                    <div class="alert alert-primary" role="alert">
                                                        '.$postStatus.'
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateModel'.$postID.'" >Assign</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade update-post animate__animated animate__fadeInDown" id="updateModel'.$postID.'" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateModalLabel">Update Post</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex">
                                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle me-3" style="width: 40px; height: 40px;" alt="Avatar" />
                                                                <div class="row mb-3">
                                                                    <small><b>'.$user_data['fullname'].'</b></small>
                                                                </div>
                                                            </div>
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="postID" value="'.$postID.'">
                                                                <div class="mb-3">
                                                                    <label for="postTitle" class="form-label">Category</label>
                                                                    <select class="form-select" aria-label="Default select example" name="category">
                                                                        <option selected>'.$postCategory.'</option>
                                                                        <option value="Software Engineering">Software Engineering</option>
                                                                        <option value="Graphic and Multimedia">Graphic and Multimedia</option>
                                                                        <option value="Networking">Networking</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="topic" class="form-label">Title</label>
                                                                    <input type="text" class="form-control" id="topic" name="topic" value="'.$postTopic.'">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="content" class="form-label">Content</label>
                                                                    <textarea class="form-control" id="content" name="content" rows="3">'.$postContent.'</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">Image</label>
                                                                    <input class="form-control form-control-sm" type="file" id="formFile" name="image">
                                                                </div>
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                
                                            $counter++;
                                        }
                                    }
                                }                           
                                ?>
                                <!-- // ?complaintid=' . $complaintid . ' -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary me-2">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="
        https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js
        "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>