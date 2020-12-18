<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_id'])) {
    header("Location: index.php");
} else {
    require 'connect.php';
    $id_user = $_SESSION['user_id'];
    $user = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$id_user'");
    $data = mysqli_fetch_assoc($user);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <!-- Logo link -->
            <a class="navbar-brand" href="home.php"><img class="navbar-logo" src="img\logo-tdt.png" alt="TDTU" style="height: 30px"> CLASSROOM</a>

            <!-- Reponsive menu -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-bell"></i>
                            <span>Notification</span>
                            <span class="badge badge-primary">3</span>
                        </a>
                    </li>
                </ul>

                <!-- Finding bar -->
                <form class="form-inline my-2 my-lg-0" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="findingClass">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="findSubmit"><i class="fa fa-search"></i></button>
                </form>

                <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo $data['avatar'] ?>" width="40" height="40" class="rounded-circle border">
                </a>

                <!-- About Account -->
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- !NAVBAR -->

    <!-- PROFILE CONTENT -->
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="e-profile">
                    <!-- FORM -->
                    <form class="form">
                        <!-- INFO -->
                        <div class="row">
                            <div class="col-12 col-sm-auto mb-3">
                                <div class="mx-auto d-flex justify-content-center align-items-center">
                                    <img src="<?php echo $data['avatar'] ?>" alt="" width="140" height="140">
                                </div>
                            </div>
                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $data['fullname'] ?></h4>
                                    <p class="mb-0">@<?php echo $data['username'] ?></p>
                                    <div class="text-muted"><small><?php echo $data['email'] ?></small></div>
                                    <input type="file" id="myfile" name="avatar">
                                </div>
                            </div>
                        </div>
                        <!-- !INFO -->

                        <ul class="nav nav-tabs">
                            <li class="nav-item active nav-link">Settings</li>
                        </ul>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $data['fullname'] ?>" name="fullname">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" name="username" value="<?php echo $data['username'] ?>" name="username" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" type="text" value="<?php echo $data['phone'] ?>" name="phone">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" value="<?php echo $data['email'] ?>" name="email" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <h5 class="my-3">Change Password</h5>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control" type="password" placeholder="••••••" name="pass">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" type="password" placeholder="••••••" name="new-pass">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                            <input class="form-control" type="password" placeholder="••••••" name="con-pass">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary mr-2" type="submit" name="change-submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                    <!-- !FORM -->

                </div>
            </div>
        </div>

    </div>
    <!-- !PROFILE CONTENT -->


</body>

</html>