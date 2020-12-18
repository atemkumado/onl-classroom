<?php?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    require("./connect.php");
    require("./processClass.php");
    include_once("processActivity.php");
    $user_id = $_SESSION['user_id']; //get id from current log-in 
    $user_name = $_SESSION['user_name'];
    $avatar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$user_id'"))['avatar'];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo link -->
            <a class="navbar-brand" href="home.php"><img class="navbar-logo" src="img\logo-tdt.png" alt="TDTU"> CLASSROOM</a>

            <!-- reponsive menu -->
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

                <!-- join/create button-->
                <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#addBtnModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <div class="modal fade" id="addBtnModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- tab title -->
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-primary" data-toggle="tab" href="#join">Join Class</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-primary" data-toggle="tab" href="#create">Create Class</a>
                                    </li>
                                </ul><br>
                                <!-- Modal -->
                                <div class="tab-content">
                                    <!-- Join class tab -->
                                    <div class="tab-pane fade show active" id="join" role="tabpanel" aria-labelledby="join-tab">
                                        <form action="./processClass.php" method="POST">
                                            <div class="form-group">
                                                <label for="">Class Code:</label>
                                                <input type="text" class="form-control" placeholder="Enter Classroom Code" name="join_code">
                                            </div>
                                            <div class="row justify-content-center">
                                                <button type="submit" class="btn btn-primary" name="join-submit">Join</button>
                                            </div>
                                        </form>

                                    </div>

                                    <!-- create class tab -->
                                    <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="">Class name:</label>
                                                <input type="text" class="form-control" placeholder="Enter Username" name="classname" require>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Group:</label>
                                                <input type="text" class="form-control" placeholder="Enter Group" name="gr" require>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Shift:</label>
                                                <input type="text" class="form-control" placeholder="Enter Shift" name="shift" require>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" name="create-submit">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finding bar -->
                <form class="form-inline my-2 my-lg-0" action="" method="POST">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search-key">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="search-submit"><i class="fa fa-search"></i></button>
                </form>

                <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-1"> <?php echo $user_name ?> </span>
                    <img src="<?php echo $avatar ?>" width="40" height="40" class="rounded-circle border">
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



    <!-- HOME WORKSHEET-->


    <div class="row mt-3">
        <!-- SIDE BAR -->
        <?php require "load_SideBar.php"; ?>

        <!-- STORAGE SPACE'S CLASSROOM  -->
        <div class="col-md-9 pl-5" name="card-columns">
            <!-- <div class="card-columns"> -->
            <div class="row mx-auto">
                <?php
                //get course of user
                $sql = "SELECT * FROM course c ,user_course uc WHERE c.id = uc.course_id AND uc.user_id = $user_id ";
                if (isset($_POST['search-submit'])) {
                    $key = $_POST['search-key'];
                    $sql .= "AND `name` LIKE '%$key%'";
                }
                $result = $conn->query($sql);
                //Activity display registered classes of user.

                while ($row = $result->fetch_assoc()) {

                ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card min-backgound mb-4">
                            <img src="<?php echo $row['background'] ?>" class="card-img-top" alt="image">
                            <div class="card-img-overlay">
                                <h5 class="card-title text-light"><?php echo $row["name"] ?></h5>
                                <p class="card-text text-light">Lecturer: <?php echo getLecturerName($row["id"]) ?></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Group: <?php echo $row["gr"] ?> - Shift: <?php echo $row["shift"] ?><br>
                                    Code: <?php echo $row["id"] ?>
                                </p>
                                <a href="classes.php?course_id=<?php echo $row["id"] ?>" class="btn btn-primary stretched-link ">Go class</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php

                //* FEATURE: CREATE a new COURSE for user
                require("connect.php");
                if (isset($_POST['create-submit'])) {
                    $classname = $_POST["classname"];
                    $gr = $_POST["gr"];
                    $shift = $_POST["shift"];
                    $code = substr(md5(uniqid(mt_rand(), true)), 0, 5);

                    //create new course
                    $sql = "INSERT INTO `course`(`id`, `user_id`,`name`,`gr`,`shift`) VALUES ('$code','$user_id', '$classname', '$gr', '$shift')";
                    $result = mysqli_query($conn, $sql);

                    //get ID from new COURSE 
                    //  **not optimize ^^ **
                    $sql = "SELECT `id` FROM `course` WHERE `name` = '$classname'AND `gr` = '$gr'AND `shift` = '$shift'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);

                    $course_id = $row[0];

                    // set association user_course
                    $linked_sql = "INSERT INTO `user_course`(`user_id`, `course_id`) VALUES ( '$user_id' ,'$course_id' )";
                    $linked_query = mysqli_query($conn, $linked_sql);


                    if ($result != 0) {
                        header("Location: home.php");
                    } else {
                        echo "<p>Create fail </p>";
                    }
                }

                ?>
            </div>

        </div>
    </div>






</body>

</html>