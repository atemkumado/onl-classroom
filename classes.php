<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- GET INFO of COURSE -->
    <?php
    require("connect.php");
    require("processClass.php");
    include_once("processActivity.php");

    if (isset($_GET["course_id"])) {
        //get course_id from current course
        $course_id = $_GET["course_id"];
        $_SESSION["course_id"] = $course_id;
    } else {
        $course_id = $_SESSION["course_id"];
    }

    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM course a WHERE a.id = '$course_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $background = $row['background'];

    $name = $row["name"];
    $gr = $row["gr"];
    $shift  = $row["shift"];

    //get lecturer name from current course
    $sql = "SELECT * FROM users u,course c WHERE c.id = '$course_id' AND u.id = c.user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $lecturer_id = $row["user_id"];
    $lecturer = $row["fullname"];
    $avatar = $row["avatar"];

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
                        <a class="nav-link dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1"> <?php echo $_SESSION["user_name"] ?> </span>
                            <img class="rounded-circle avatar" src="<?php echo $row['avatar'] ?>">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- WORKSHEET -->
    <div class="row mt-3">
        <!-- SIDE BAR -->
        <?php require "load_SideBar.php"; ?>

        <!-- STORAGE SPACE'S ACTIVITY -->
        <div class="col-md-9" name="card-columns">

            <div class="tab-content container" id="myTabContent">

                <!-- STREAM TAB-->
                <div class="tab-pane fade show active mt-2" id="stream" role="tabpanel" aria-labelledby="stream-tab">
                    <!-- background class title -->
                    <div class="header mb-3">
                        <?php
                        $hidden = "";
                        if ($user_id != $lecturer_id) {
                            $hidden = "hidden";
                        }
                        ?>
                        <div class="card">
                            <img class="img-fluid rounded" src="<?php echo $background ?>" class="card-img" alt="image">
                            <div class="card-img-overlay text-white">
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        <h5 class="card-title"><?php echo $name ?></h5>
                                        <div class="card-text">Teacher: <?php echo $lecturer ?></div>
                                        <div class="card-text">Group: <?php echo $gr ?> - shift <?php echo $shift ?> </div>
                                        <div class="card-text">Code: <?php echo $course_id ?></div>
                                    </div>
                                    <div <?php echo $hidden ?>>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editClassModal">
                                            <i class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delClassModal">
                                            <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal show EDIT CLASS-->
                        <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg " role="document">
                                <div class="modal-content">
                                    <!-- create class tab -->
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title">Edit Course</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="./processClass.php" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                            <div class="form-group">
                                                <label for="">Class name:</label>
                                                <input type="text" class="form-control" name="classname" value="<?php echo $name ?>" require>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Group:</label>
                                                <input type="text" class="form-control" name="gr" value="<?php echo $gr ?>" require>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Shift:</label>
                                                <input type="text" class="form-control" name="shift" value="<?php echo $shift ?>" require>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Background:</label>
                                                <select class="form-control" name="background">
                                                    <?php
                                                    $bg = mysqli_query($conn, "SELECT * FROM `backgrounds`");
                                                    while ($row = mysqli_fetch_assoc($bg)) {
                                                    ?>
                                                        <option value="<?php echo $row['image'] ?>"><?php echo substr($row['image'], 4, -4) ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                            <button class="btn btn-info" name="edit-submit" type="submit">OK</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal show DELETE CLASS -->
                        <div class="modal fade" id="delClassModal" tabindex="-1" role="dialog" aria-labelledby="delClassModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delClassModalLabel">Delete: <?php echo $name ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="./processClass.php">
                                        <div class="modal-body">
                                            Are you sure you want to delete this class?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                            <button class="btn btn-danger" name="delete-class" type="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Posting Form -->
                    <form class="border rounded mb-3" action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                        <!-- text input -->
                        <div class="form-group px-2 pt-3">
                            <textarea class="form-control" name="description" rows="3" placeholder="Share with your class: " require></textarea>
                        </div>
                        <div class="form-group row px-2">
                            <!-- up file -->
                            <div class="col-sm pb-2">
                                <div class="custom-file">
                                    <!-- <input type="file" class="custom-file-input" id="customFile" name="fileUpload"></input> -->
                                    <label class="custom-file-label" for="customFile"></label>
                                    <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload">
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
                                <button type="submit" class="btn btn-primary" name="activity-submit">Post</button>
                            </div>
                        </div>
                    </form>


                    <!-- Activity space-->
                    <div class=" activity-space mt-3">
                        <?php
                        //get course of user
                        $sql = "SELECT * FROM activity,user_activity u, course_activity c WHERE id = c.activity_id AND c.course_id = '$course_id' AND id = u.activity_id ORDER BY id DESC";
                        $result = $conn->query($sql);

                        //* FEATURE: DISPLAY all activity of course.
                        while ($row = $result->fetch_assoc()) {
                            displayActivity($row, $lecturer_id, $user_id);
                        }
                        ?>
                    </div>
                </div>

                <!-- CLASSWORK TAB -->
                <div class="tab-pane fade" id="classwork" role="tabpanel" aria-labelledby="classwork-tab">
                    <p class="h4 font-weight-normal text-primary">Assignment: </p>
                    <div class="assignment-content">
                        <div class="card mb-3 mt-4">
                            <div class="card-body d-flex">
                                <span class="align-self-center mr-4">
                                    <i class="far fa-file-alt fa-2x" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <a class="font-weight-bold text-dark stretched-link" data-toggle="modal" data-target="#openAssignment">Task 1</a>
                                    <div><small>Date post: 20/10/2020</small></div>
                                </span>
                                <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>


                        <div class="card mb-3 mt-4">
                            <div class="card-body d-flex">
                                <span class="align-self-center mr-4">
                                    <i class="far fa-file-alt fa-2x" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <a class="font-weight-bold text-dark stretched-link" data-toggle="modal" data-target="#openAssignment">Task 2</a>
                                    <div><small>Date post: 27/10/2020</small></div>
                                </span>
                                <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>

                        <div class="card mb-3 mt-4">
                            <div class="card-body d-flex">
                                <span class="align-self-center mr-4">
                                    <i class="far fa-file-alt fa-2x" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <a class="font-weight-bold text-dark stretched-link" data-toggle="modal" data-target="#openAssignment">Task 3</a>
                                    <div><small>Date post: 03/11/2020</small></div>
                                </span>
                                <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>

                        <div class="card mb-3 mt-4">
                            <div class="card-body d-flex">
                                <span class="align-self-center mr-4">
                                    <i class="far fa-file-alt fa-2x" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <a class="font-weight-bold text-dark stretched-link" data-toggle="modal" data-target="#openAssignment">Mid-term review</a>
                                    <div><small>Date post: 04/11/2020</small></div>
                                </span>
                                <button class="btn ml-auto"><i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i></button>
                            </div>
                        </div>

                        <div class="modal fade" id="openAssignment" tabindex="-1" role="dialog" aria-labelledby="openAssignmentLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="openAssignmentLabel">HomeWork</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- <div class="row"> -->
                                        <!-- <div class="col-sm-9"> -->
                                        <!-- 2.2.1 Hiển thị thông tin bài tập -->
                                        <div>
                                            <h4 class="">Luyện đề</h4>
                                            <div class="text-secondary">Tran Thi Dan | Aug 18 </div> <!-- Lấy tên giao viên và Ngày tháng đăng -->
                                            <div class="text-secondary"><b>100 points</b></div>
                                        </div>
                                        <hr>
                                        <!-- 2.2.2 Phần hiển thị nội dung chi tiết bài tập -->
                                        <div class="h5">
                                            Phân tích hình tượng Sóng trong bài thơ cùng tên của Xuân Quỳnh để cảm nhận về tâm hồn người phụ nữ trong tình yêu
                                            qua bài thơ, từ đó liên hệ với hình tượng người phụ nữ Việt ngày nay?
                                            <!-- đang xử lý hiển thị file, download -->
                                        </div>
                                        <hr>
                                        <!-- </div> -->
                                        <!--  Hiển thị phần nộp bài -->
                                        <!-- <div class="col-sm-3"> -->
                                        <div class="d-flex mb-3">
                                            <h5>Your work</h5>
                                            <div class="ml-auto">Not yet</div>
                                        </div>
                                        <div>
                                            <!-- div hiển thị file, liên kết hoặc text đã upload -->
                                        </div>
                                        <div class="dropdown show mb-3">
                                            <a class="btn btn-secondary btn-block dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-plus mr-2" aria-hidden="true"></i>Add or create
                                            </a>
                                            <div class="dropdown-menu text-secondary" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLink">
                                                    <i class="fa fa-link mr-2" aria-hidden="true"></i>
                                                    <span>Link</span>
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalFile">
                                                    <i class="fa fa-file mr-2" aria-hidden="true"></i>
                                                    <span>File</span>
                                                </a>
                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#modalText">
                                                    <i class="fa fa-file-text-o mr-2" aria-hidden="true"></i>
                                                    <span>Text</span>
                                                </a>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block">Turn in</button>
                                        <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-info" href="assignment.php">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- MEMBER TAB -->
                <div class="tab-pane fade pt-3" id="people" role="tabpanel" aria-labelledby="people-tab">

                    <div class="h4 font-weight-normal text-primary">Teacher</div>
                    <hr>
                    <div class="d-flex bd-highlight mt-3">
                        <img class="rounded-circle mr-3 avatar" src="<?php echo $avatar ?>" alt="Teacher Image">
                        <div class="align-self-center"><?php echo $lecturer ?></div>
                    </div>
                    <br><br>
                    <?php
                    $sql = "SELECT * FROM users u WHERE u.id in (SELECT uc.user_id FROM user_course uc WHERE uc.course_id = '$course_id') AND u.id != $lecturer_id";
                    $result = mysqli_query($conn, $sql);
                    if ($result === FALSE) {
                        echo $conn->error;
                    }
                    ?>
                    <div class="d-flex">
                        <span class="h4 font-weight-normal text-primary mr-2">Classmates</span>
                        <span class="align-self-center">(<?php echo mysqli_num_rows($result) ?> student<?php echo mysqli_num_rows($result) > 1 ? 's' : '' ?>)</span>
                        <button <?php echo $hidden ?> class="btn text-primary ml-auto" data-toggle="modal" data-target="#addMemberModal">
                            <i class="fa fa-user-plus fa-lg"></i>
                        </button>
                    </div>
                    <hr class="mt-1">
                    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addMemberModalLabel">Add student</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="">
                                    <div class="modal-body">
                                        <label for="">Input Email</label>
                                        <input class="form-control" type="email" name="add-email" placeholder="example@mail.com">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="add-member" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['add-member'])) {
                                    // SEND CODE
                                    require_once('PHPMailer/PHPMailerAutoload.php');
                                    $mail = new PHPMailer();
                                    $mail->isSMTP();
                                    $mail->SMTPAuth = true;
                                    $mail->SMTPSecure = 'ssl';
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->Port = '465';
                                    $mail->isHTML(true);
                                    $mail->Username = 'hieutada2k@gmail.com';
                                    $mail->Password = 'pikapika7322';
                                    $mail->SetFrom('no-reply@tdtu.edu.vn', 'Admin');
                                    $mail->Subject = 'TDTU Classroom - Invitation';
                                    $content = "
                                    <div>Invitation to join '" . $name . "' class came from " . $lecturer . ": </div><br>
                                    <span style='background-color: yellow; font-size:150%;'>" . $course_id . "</span>
                                    ";
                                    $mail->Body = $content;
                                    $mail->AddAddress($_POST['add-email']);
                                    $mail->Send();
                                    // !SEND CODE
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="d-flex bd-highlight mt-2">
                            <img class="rounded-circle mr-3 avatar" src="<?php echo $row["avatar"] ?>" alt="<?php echo $row["avatar"] ?>">
                            <div class="align-self-center mr-auto"><?php echo $row["fullname"] ?></div>
                            <button <?php echo $hidden ?> type="button" class="btn btn-sm text-secondary" data-toggle="modal" data-target="#delMemberModal">
                                <i class="fa fa-trash fa-lg"></i>
                            </button>
                        </div>
                        <div class="modal fade" id="delMemberModal" tabindex="-1" role="dialog" aria-labelledby="delMemberModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delMemberModalLabel">Delete: <?php echo $row["fullname"] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="./processClass.php">
                                        <input type="hidden" name="student_id" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                        <div class="modal-body">
                                            Are you sure you want to delete this student?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="delete-member" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

    <!-- CHẶN GỬI BIỂU MẪU KHI RESET TRANG -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>