<?php ob_start();?>
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
        include_once ("processActivity.php");
        $user_id = $_SESSION['user_id']; //get id from current log-in 
        $user_name = $_SESSION['user_name'];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Logo link -->
        <a class="navbar-brand pl-4" href="#">TDTU Classroom</a>

        <!-- reponsive menu -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
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
            <form class="form-inline my-2 my-lg-0" method="POST">
                <input class="form-control mr-sm-2" type="search" placeholder="Ex: Web 6 3" aria-label="Search" name="findingClass">
                <button  class="btn btn-outline-success my-2 my-sm-0"  name = "findSubmit"><i class="fa fa-search"></i></button>   
            </form>

            <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span > <?php echo $user_name ?> </span>
                <img src="img/male-avatar-icon-52.png" width="40" height="40" class="rounded-circle border">
            </a>

            <!-- About Account -->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
        </div>
    </nav>

 

    <!-- HOME WORKSHEET-->

    
    <!-- SIDE BAR -->
    <div class="row mt-3">
        <div class="col-md-3" name="side-bar">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Classroom
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            To-do
                        </a>
                    </li>
                    <li class="list-group-item ">
                        <p>Registered:</p>
                        <div class="overflow-auto" style="max-height: 300px;">
                            <?php 
                                require("connect.php");
                                $sql = "SELECT * FROM course WHERE id in ( SELECT course_id FROM user_course WHERE user_id =$user_id )";
                                $result = mysqli_query($conn,$sql);
                                while ($row = $result->fetch_assoc()){    
                            ?>
                                <div class="d-flex bd-highlight mb-2 pl-2">
                                    <img class="rounded-circle" src="img/background_title_cardView-01.jpg" alt="Teacher Image" style="width: 40px; height:40px">
                                    <a class="nav-link" href="#"><?php echo $row["name"] ?></a>
                                </div>
                                <?php }?>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            Storage
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            Setting
                        </a>
                    </li>
                </ul>
            </div>

        <!-- STORAGE SPACE'S CLASSROOM  -->
        <div class = "col-md-9 pl-5" name="card-columns">
            <div class = "card-columns">
                <?php 
                
                
                //get course of user
                $sql = "SELECT * FROM course c ,user_course uc WHERE c.id = uc.course_id AND uc.user_id = $user_id ";
                $result = $conn->query($sql);
                //Activity display registered classes of user.
                
                while($row = $result->fetch_assoc()) {
                        
                ?>
                <div class="card" style="min-width:150px; max-width:300px">

                    <img src="img/background_title_cardView_02.jpg" class="card-img" alt="image" style="filter: brightness(80%);width:100%; height:150px ">
                    <div class="card-img-overlay">
                        <div style="display: flex;">
                            <h5 class="card-title " style="color: white;"><?php echo $row["name"] ?></h5>
                            <p style="color: white; left:20px; top:45px; position:absolute">Lecturer: <?php echo getLecturerName($row["id"]) ?></p>
                        </div>
                    </div>
                    <div class="card-body" >
                        <p class="card-text mb-2" style="font-size: 14px"> <?php echo "Group: ".$row["gr"]." - Shift: ".$row["shift"] ?> <br>Code: <?php echo $row["id"] ?>  </p>
                        <form method="POST" action="./classes.php">
                        <input value ="<?php echo $row["id"] ?>"  type="hidden" name="course_id">
                            <button  class="btn btn-primary stretched-link ">Go class</button>
                        </form>
                    </div>
                </div>
                    <?php
                    }
                    ?>
            <?php
                                        
                //* FEATURE: CREATE a new COURSE for user
                require("connect.php");
                if (isset($_POST['create-submit'])) {
                    $classname= $_POST["classname"];
                    $gr= $_POST["gr"];
                    $shift= $_POST["shift"];
                    
                    //create new course
                    $sql = "INSERT INTO course(user_id,name,gr,shift) VALUES ($user_id, '$classname', '$gr', '$shift')";
                    $result = mysqli_query($conn,$sql);
                    
                    //get ID from new COURSE 
                    //  **not optimize ^^ **
                    $sql = "SELECT id FROM course WHERE name = '$classname'AND gr = '$gr'AND shift = '$shift'"; 
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result); 
                    
                    $course_id = $row[0]; 

                    // set association user_course
                    $linked_sql = "INSERT INTO user_course(user_id, course_id) VALUES ( '$user_id' ,'$course_id' )";
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