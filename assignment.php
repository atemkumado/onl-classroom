<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="home.php"><img class="navbar-logo" src="img\logo-tdt.png" alt="TDTU"> CLASSROOM</a>

            <!--reponsive menu button  -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs mx-auto justify-content-center" id="myTab" role="tablist">

                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- avtar user -->
                    <li class="nav-item">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <span> <?php echo $_SESSION["user_name"] ?> </span> -->
                            <img class="rounded-circle avatar" src="img/user.png">
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

    <div class="row mt-3">
        <div class="col-sm-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <a class="nav-link" href="./home.php">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Classroom
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" href="todo.php">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                        To-do
                    </a>
                </li>
                <li class="list-group-item ">
                    <p>Registered:</p>
                    <div class="overflow-auto">
                        
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
        <div class="col-sm-9">
            <div class="container-fluid mt-3" id="tab-content">
                <div class="row">
                    <div class="col-sm-9">
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
                        <!-- 2.2.3 Phần hiện comment -->
                        <div>
                            <h5 class="text-secondary pb-2"><i class="fa fa-comments-o" aria-hidden="true"></i> Class comments</h5>
                            <!-- Load comment của những người khác tại đây -->
                            <div class="d-flex mt-3">
                                <img class="rounded-circle mr-3 avatar" src="https://via.placeholder.com/40x40?text=Avt" alt="Teacher Image">
                                <div>
                                    <h6>Nguyễn Thành Long</h6>
                                    <div>
                                        Trời ơi bài khó quá vậy thầy!
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex mt-3">
                                <img class="rounded-circle mr-3 avatar" src="https://via.placeholder.com/40x40?text=Avt" alt="Teacher Image">
                                <div class="mr-auto">
                                    <h6>Đinh Hồng Hà</h6>
                                    <div>
                                        Game Esay :))
                                    </div>
                                </div>
                                <button class="btn"> <i class="fa fa-reply" aria-hidden="true"></i> </button>
                            </div>
                            <hr>
                            <form action="" method="POST">
                                <div class="input-group">
                                    <img class="rounded-circle mr-2" src="https://via.placeholder.com/40x40?text=Avt" alt="User Image">
                                    <input type="text" class="form-control" placeholder="Type your message here..">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 2.2.2 Hiển thị phần nộp bài -->
                    <div class="col-sm-3">
                        <div class="d-flex mb-3">
                            <h5>Your work</h5>
                            <div class="ml-auto">Status</div>
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
                    </div>
                </div>

                <!-- modal turn in File-->
                <div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body mx-3">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <h5>Choose your file</h5>
                                        <input type="file" class="custom-file-input" id="customFile" name="turnFile">
                                    </div>
                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    <div class="modal-footer d-flex">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal turn in Link-->
                <div class="modal fade" id="modalLink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body mx-3">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <h5>Paste your answer</h5>
                                        <input type="text" name="turnLink" class="form-control">
                                    </div>
                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    <div class="modal-footer d-flex">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal turn in Text-->
                <div class="modal fade" id="modalText" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body mx-3">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <h5>Input your answer</h5>
                                        <textarea name="turnText" class="form-control" rows="3"></textarea>
                                    </div>
                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    <div class="modal-footer d-flex">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>