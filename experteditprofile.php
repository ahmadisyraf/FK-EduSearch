<?php
    session_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <?php include "components/navigation.php"; ?>
    <div class="d-flex flex-column justify-content-center align-item-center vh-100 px-5">
        <h3 class="mt-5">Edit Profile</h3>
        <div class="card text-left w-90">
            <div class="card-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="experteditresearch.php">Research</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="experteditpublication.php">Publication</a>
                </li>
            </ul>
            </div>
            <div class="card-body">
                <form class="row g-3">
                <div class="col-md-12">
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" style="width: 200px;"
                    alt="Avatar"/>
                </div>
                <div class="col-md-4">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname">
                </div>
                <div class="col-md-4">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname">
                </div>
                <div class="col-md-4">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" id="username" placeholder="e.g: ali" aria-label="Username" aria-describedby="basic-addon1">
                    </div> 
                </div>
                <div class="col-md-8">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="e.g: Kuantan">
                </div>
                <div class="col-md-2">
                    <label for="inputState" class="form-label">State</label>
                    <select class="form-select" id="inputState" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Perlis">Peris</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Johor">Johor</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Pulau Pinang">Pulau Pinang</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="WPKL">WP Kuala Lumpur</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="e.g: ali@gmail.com">
                </div>
                <div class="col-md-8">
                    <label for="inputAcademic1" class="form-label">Academic</label>
                    <input type="text" class="form-control" id="inputAcademic1" placeholder="e.g: Computer Science (2005 - 2014), Universiti Teknologi Malaysia, Skudai">
                </div>
                <div class="col-md-4">
                    <label for="inputSocialAcc" class="form-label">Social Account</label>
                    <input type="text" class="form-control" id="inputSocialAcc" placeholder="e.g: https://twitter.com/ali">
                </div>
                <div class="col-md-12">
                    <label for="inputBio" class="form-label">Bio</label>
                    <textarea class="form-control" id="inputBio"></textarea>
                </div>
                <div class="col-md-12">
                <label for="inputCV" class="form-label">CV</label>
                    <input type="file" class="form-control" id="inputCV" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <div class="col-md-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>