<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
    } else {
        require 'connect.php';
        $user_id = $_SESSION['user_id'];
        $avatar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$user_id'"))['avatar'];
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="home.php"><img class="navbar-logo" src="img\logo-tdt.png" alt="TDTU"> CLASSROOM</a>

            <!--reponsive menu button  -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="assigned-tab" data-toggle="tab" href="#assigned" role="tab" aria-controls="assigned" aria-selected="true">Assigned</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="missing-tab" data-toggle="tab" href="#missing" role="tab" aria-controls="missing" aria-selected="false">Missing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- avtar user -->
                    <li class="nav-item">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span> <?php echo $_SESSION["user_name"] ?> </span>
                            <img class="rounded-circle avatar" src="<?php echo $avatar ?>">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" name="logout"></i> Logout</a>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row mt-3">
        <?php require "load_SideBar.php" ?>
        <div class="col-md-9 tab-content" id="myTabContent">
            <!-- 2.2.0 Lựa chọn lớp học -->
            <form class="row" action="" method="post">
                <div class="form-group col-3">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <!-- 2.2.1 Assigned tab-->
            <div class="tab-pane fade show active mt-3" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
                <!-- Load card bài tập tại đây-->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Bài tập 24H (50%)</a>
                            <div><small>Thái độ sống 2</small></div>
                            <div><small>Date post: 29/11/2020</small></div>
                        </span>
                        <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Nộp slide thuyết trình</a>
                            <div><small>Thực tập doanh nhiệp</small></div>
                            <div><small>Date post: 24/11/2020</small></div>
                        </span>
                        <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <!-- 2.2.2 Missing tab -->
            <div class="tab-pane fade mt-3" id="missing" role="tabpanel" aria-labelledby="missing-tab">
                <!-- Load card bài tập missing tại đây-->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Tên bài tập</a>
                            <div><small>Lớp học</small></div>
                        </span>
                        <div class="align-self-center ml-auto text-danger"><b>Wednesday, Oct 30, 2019</b></div>
                    </div>
                </div>
            </div>

            <!-- 2.2.3. Done tab -->
            <div class="tab-pane fade mt-3" id="done" role="tabpanel" aria-labelledby="done-tab">
                <!-- Đã cho điểm -->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Tên bài tập</a>
                            <div><small>Lớp học</small></div>
                        </span>
                        <div class="align-self-center ml-auto text-secondary"><b>9.5/10</b></div>
                    </div>
                </div>
                <!-- Đã nộp -->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Tên bài tập</a>
                            <div><small>Lớp học</small></div>
                        </span>
                        <div class="align-self-center ml-auto text-secondary"><b>Turned-in</b></div>
                    </div>
                </div>
                <!-- Nộp trễ -->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <span class="align-self-center mr-3">
                            <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        </span>
                        <span>
                            <a href="assignment.php" class="font-weight-bold text-dark stretched-link">Tên bài tập</a>
                            <div><small>Lớp học</small></div>
                        </span>
                        <div class="align-self-center ml-auto text-secondary">
                            <b>Turned-in</b> <br><small>(Done late)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>