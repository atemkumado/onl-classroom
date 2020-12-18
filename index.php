<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="mx-auto mt-3 p-3 border login-frame">
        <img class="rounded mx-auto d-block pb-3" src="img/logo.png" alt="logo image" width="50%">

        <!-- tab bar -->
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login">Log-in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#signup">Sign-up</a>
            </li>
        </ul><br>

        <!-- tab content -->
        <div class="tab-content">
            <!-- login tab -->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" class="form-control" placeholder="Enter Username" name="login-username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="login-password" required>
                    </div>
                    <div class="form-group d-flex">
                        <a href="" data-toggle="modal" data-target="#forgotPassModal">Forgot password?</a> <!-- Button trigger modal -->
                        <div class="mx-auto"></div>
                        <a href="">Login with Admin</a>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary" name="login-submit">Log-in</button>
                    </div>
                </form>
            </div>
            <!-- sign-up tab-->
            <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                <form action="confirm.php" method="POST">
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" class="form-control" placeholder="Enter Username" name="signup-username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Full Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="signup-fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="signup-email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number:</label>
                        <input type="text" class="form-control" placeholder="Enter Phone Number" name="signup-phone" required>
                    </div>
                    <div class="form-group">
                        <label for="">Date of birth:</label>
                        <input type="date" class="form-control" placeholder="Enter your date" name="signup-date" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="signup-password" required>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="confirm" value="1" required>
                            I have read it carefully and accept <a href="" data-toggle="modal" data-target="#termsModal">The Terms</a>
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary" name="signup-submit">Sign-up</button>
                    </div>
                </form>
            </div>
        </div> <br>

        <!-- Modal -->
        <div class="modal fade" id="forgotPassModal" tabindex="-1" role="dialog" aria-labelledby="forgotPassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotPassModalLabel">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="formResetPass.php" method="post">
                        <div class="modal-body">
                            <input class="form-control" type="text" name="f-username" placeholder="Username" required><br>
                            <input class="form-control" type="email" name="f-email" placeholder="E-Mail" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="f-submit">Reset pass</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">The Terms</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>This is a product made at Ton Duc Thang University including the members:</p>
                        <p>
                            Ta Trung Hieu - 518H0502 <br>
                            Nguyen Thanh Long - 518H0217 <br>
                            Tran Hong Toan - 518h0578 <br>
                        </p>
                        <p>Please do not copy and use for other purposes without our consent.</p>
                        Thank you!
                    </div>
                </div>
            </div>
        </div>

        <?php
        session_start();
        require 'connect.php';

        // LOGIN
        if (isset($_POST['login-submit'])) {
            $username = addslashes($_POST['login-username']); // Avoid SQL injector
            $password = addslashes($_POST['login-password']); // Avoid SQL injector
            $password  = md5($password);
            $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
            $query = $conn->query($sql);
            if ($query->num_rows != 0) {
                $rows = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] =  $rows['id'];
                $_SESSION['user_name'] = $rows['fullname'];
                header("Location: home.php");
            } else {
                echo "<p>You entered the wrong name or password</p>";
            }
        }
        ?>
    </div>
</body>

</html>