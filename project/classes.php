<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<!-- GET INFO of COURSE -->
<?php 
    require("connect.php");
    require("processClass.php");
    include_once ("processActivity.php");    
    if(isset($_POST["course_id"])){
        //get course_id from current course
        $course_id = $_POST["course_id"];
        $_SESSION["course_id"] = $course_id;
        
    }else{
        $course_id = $_SESSION["course_id"];
    }

    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM course a WHERE a.id = $course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row["name"];
    $gr = $row["gr"];
    $shift  = $row["shift"];

        //get lecturer name from current course
    $sql = "SELECT * FROM users u,course c WHERE c.id = $course_id AND u.id = c.user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $lecturer_id = $row["user_id"];
    $lecturer = $row["fullname"];
        
    ?>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
           
            <div class="navbar-header">
                <!-- class name -->
                <a class="navbar-brand" href="home.php">TDTU Classroom</a> 
            </div>

            <!--reponsive menu button  -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs mx-auto justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="stream-tab" data-toggle="tab" href="#stream" role="tab" aria-controls="stream" aria-selected="true">Stream</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="classwork-tab" data-toggle="tab" href="#classwork" role="tab" aria-controls="classwork" aria-selected="false">Classwork</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="people-tab" data-toggle="tab" href="#people" role="tab" aria-controls="people" aria-selected="false">People</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- avtar user -->
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span > <?php echo $_SESSION["user_name"]?> </span>
                            <img class="rounded-circle" src="img/male-avatar-icon-52.png" style="width:40px; height:40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            
                                <a class="dropdown-item" href="index.php"><i class="fa fa-sign-out" name="logout"></i> Logout</a>
                            
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <!-- WORKSHEET -->
    <div class="row mt-3">
        <!-- SIDE BAR -->
        <div class="col-md-3" name="side-bar">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="nav-link" href="./home.php">
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
                                //LIST ALL COURSE of user
                                $sql = "SELECT * FROM course WHERE id in ( SELECT course_id FROM user_course WHERE user_id =$user_id )";
                                $result = mysqli_query($conn,$sql);
                                while ($row = $result->fetch_assoc()){    
                            ?>
                                <div class="d-flex bd-highlight mb-2 pl-2">
                                    <img class="rounded-circle" src="img/background_title_cardView-01.jpg" style="width:40px; height:40px;" alt="Teacher Image" style="width: 40px; height:40px">
                                    <form action="" method="post">
                                        <a class="nav-link" href="#" name=""><?php echo $row["name"] ?></a>
                                    </form>
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

        <!-- STORAGE SPACE'S ACTIVITY -->
        <div class = "col-md-9 pl-3 pr-5 " style="padding-bottom: 60px;" name="card-columns">

            <div class="tab-content container" id="myTabContent">
                <!-- STREAM TAB-->
                <!-- background class title -->
                <div class="tab-pane fade show active mt-3" id="stream" role="tabpanel" aria-labelledby="stream-tab">
                    <div class="header" style="margin-bottom:25px;">
                            <figure style="position: relative;">
                                
                                  
                                <img class="bg-class-header" src="img/class-title.jpg" style="filter: brightness(50%);" />
                                    
                                <h3 class="class-title" style ="font-size:40px" ><?php echo $name ?> </h3>
                                <p class="class-description" >Lecturer: <?php echo $lecturer ?> <br> Group: <?php echo $gr ?> - Shift <?php echo $shift ?> <br> Code: <?php echo $course_id ?> </p>     
                                
                                <?php 
                                        if($user_id == $lecturer_id){
                                            echo'
                                            <form method="POST" action = "./processClass.php"> 
                                                <input type = "hidden" name="course_id" value="<?php echo $course_id ?>" >                                        
                                                <button name="delete-class" style="position: absolute;  right:0;  top: 0;" >Delete</button>
                                            </form>
                                            <button name="edit1-class" class="pl-3 pr-3" data-toggle="modal" data-target="#addBtnModal" style="position: absolute;  right:0;  top: 40px;">Edit</button>
                                            
                                            ';
                                        }
                                    ?>
                                </figure>
                    </div>
                    
                        <div class="modal fade" id="addBtnModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg " role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- tab title -->
                                        <br>
                                        <!-- Modal -->
                                        <div class="content">
                                            <!-- create class tab -->
                                            <h5 class="active text-primary pb-4" style="margin: auto; text-align:center; "><p> Edit Course</p></h5>
                                                <form action="./processClass.php" method="POST">
                                                <input type = "hidden" name="course_id" value="<?php echo $course_id ?>" >
                                                    <div class="form-group">
                                                        <label for="">Class name:</label>
                                                        <input type="text" class="form-control"  name="classname" value="<?php echo $name ?>" require >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Group:</label>
                                                        <input type="text" class="form-control"  name="gr" value="<?php echo $gr ?>" require>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Shift:</label>
                                                        <input type="text" class="form-control" name="shift" value="<?php echo $shift ?>" require>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-primary" name="edit-submit">Edit</button>
                                                    </div>
                                                </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    <!-- Posting Form -->
                    <form class="border rounded mb-3" action="" method="POST">
                        <input type = "hidden" name="course_id" value="<?php echo $course_id ?>" >
                        <input type = "hidden" name="user_id" value="<?php echo $user_id ?>" >
                        <!-- text input -->
                        <div class="form-group px-2 pt-3">
                            <textarea class="form-control" name="description" rows="3" placeholder="Share with your class: " require ></textarea>
                        </div>
                        <div class="form-group row px-2">
                            <!-- up file -->
                            <div class="col-sm pb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="fileUpload"></input>
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                                <script>
                                    $(".custom-file-input").on("change", function() {
                                        var fileName = $(this).val().split("\\").pop();
                                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                    });
                                </script>
                            </div>
                            <!-- submit document -->
                            <div class="col-sm pb-2">
                                <button type="submit" class="btn btn-primary" name="activity-submit" >Post</button>
                            </div>
                        </div>
                    </form>


                    <!-- Activity space-->
                    <div class=" activity-space mt-3">
                        <?php 
                            //get course of user
                            $sql = "SELECT * FROM activity,user_activity u, course_activity c WHERE id = c.activity_id AND c.course_id = $course_id AND id = u.activity_id ";
                            $result = $conn->query($sql);

                            //* FEATURE: DISPLAY all activity of course.
                            while($row = $result->fetch_assoc()) {
                               displayActivity($row,$lecturer_id,$user_id);
                             }     
                        ?>  
                    </div>
                </div>
                
                <!-- CLASSWORK TAB -->
                <div class="tab-pane fade" id="classwork" role="tabpanel" aria-labelledby="classwork-tab">

                </div>

                <!-- MEMBER TAB -->
                <div class="tab-pane fade mt-3" id="people" role="tabpanel" aria-labelledby="people-tab">
                    <div class="container">
                    <!-- teacher -->
                        <span class="h4 font-weight-normal text-primary mr-2">Teacher</span><hr>
                        <div class="d-flex bd-highlight mt-3">
                            
                            <img class="rounded-circle mr-3" src="img/male-math-teacher-vector.jpg" alt="Teacher Image"  style="width:40px; height:40px;">
                            <!-- * FEATURE: GET TEACHER NAME *-->
                    
                            
                            <div class="align-self-center"><?php echo $lecturer ?></div>
                        </div>
                        <br>
                        <!-- classmate -->
                        <?php 
                                $sql = "SELECT * FROM users u WHERE u.id in (SELECT uc.user_id FROM user_course uc WHERE uc.course_id = $course_id) AND u.id != $lecturer_id";
                                $result=mysqli_query($conn,$sql);
                                if($result === FALSE)
                                { echo $conn->error ;}
                        ?>
                        <span class="h4 font-weight-normal text-primary mr-2">Classmates</span>
                        <span class="align-self-center">( <?php echo $result->num_rows ?> members)</span><hr>
                            
                            <?php
                                while ($row= $result->fetch_assoc()){
                            ?>
                                <form method="POST" action="./processClass.php" > 
                                    <div class="row">
                                        <div class="mr-4 mt-2" >
                                            <?php
                                                if($user_id == $lecturer_id){
                                                    echo'
                                                        <button style="background:none; border:none" name="delete-member" class="mt-3" >
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg> 
                                                      </button>
                                                    ';}
                                            ?>
                                        </div>
                                        
                                        <div style="display: inline" >
                                            <input type ="hidden" name="student_id" value="<?php echo $row['id'] ?>" >
                                            <input type ="hidden" name="course_id" value="<?php echo $course_id ?>" >
                                            <div class="d-flex bd-highlight mt-3">
                                                <img class="rounded-circle mr-3" src="img/male-avatar-icon-52.png" alt="Teacher Image"  style="width:40px; height:40px;">
                                                <span class="align-self-center"><?php echo $row["fullname"] ?></span>
                                            </div>
                                        </div>
                                        
                                    </div>
    
                                </form>
                            <?php } ?>
                        </div>  
                    </div>
                </div>

        </div>

</body>

</html>


