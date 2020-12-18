<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>



<body>
    <div class="container">
        <?php
        require "connect.php";
        $hide = "";
        if (isset($_POST['signup-submit'])) {
            $username = $_POST['signup-username'];
            $password = $_POST['signup-password'];
            $fullname = $_POST['signup-fullname'];
            $email = $_POST['signup-email'];
            $phone = $_POST['signup-phone'];
            $date = $_POST['signup-date'];
            $err = array(); // Error Message Array

            if ($username == '' || $password == '' || $fullname == '' || $email == '' || $phone == '' || $date == '') {
                echo "<p>you must fill out all information</p>";
            } else {
                if (preg_match('@[^\w]@', $username)) {
                    $err[] = "Username cannot contain special characters";
                }
                if (!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
                    $err[] = "Only letters and white space allowed";
                }
                if (strlen($password) < 8) {
                    $err[] = "Password must be greater than 8 characters";
                } else {
                    $password = md5($password);
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $err[] = "Invalid email format";
                }
                if (!preg_match('/^[0-9]/', $phone)) {
                    $err[] = "Invalid phone number";
                }
                if (!isset($_POST['confirm'])) {
                    $err[] = "You must accept the terms";
                }

                if (count($err) > 0) {
                    $hide = "hidden";
                    foreach ($err as $mess) {
                        echo '<div class="alert alert-danger" role="alert">' . $mess . '</div>';
                    }
                    echo "<script>setTimeout(\"location.href = 'index.php';\",2000);</script>";
                }
            }
        }
        ?>
        <?php $code = substr(md5(uniqid(mt_rand(), true)), 0, 7); ?>

        <div class="d-flex">
            <form class="form-inline my-3" action="" method="POST" <?php echo $hide ?>>
                <input type="hidden" name="confirm-username" value="<?php echo $username ?>">
                <input type="hidden" name="confirm-password" value="<?php echo $password ?>">
                <input type="hidden" name="confirm-fullname" value="<?php echo $fullname ?>">
                <input type="hidden" name="confirm-email" value="<?php echo $email ?>">
                <input type="hidden" name="confirm-phone" value="<?php echo $phone ?>">
                <input type="hidden" name="confirm-date" value="<?php echo $date ?>">
                <input type="hidden" name="confirm-code" value="<?php echo $code ?>">
                <input class="form-control" type="text" name="input-code" id="" placeholder="Enter code">
                <button class="btn btn-primary" type="submit" name="confirm-submit">Confirm</button>
            </form>

            <form id="formSend" class="m-3" action="send_code.php" method="POST" target="_blank" <?php echo $hide ?>>
                <input type="hidden" name="send_code" value="<?php echo $code ?>">
                <input type="hidden" name="send_email" value="<?php echo $email ?>">
                <button id="btnSend" class="btn btn-info" type="submit">Send confirm code to email</button>
            </form>
        </div>
        <div id="some_div"></div>


        <?php

        if (isset($_POST['confirm-submit'])) {
            $a = $_POST['confirm-code'];
            $b = $_POST['input-code'];
            $username = $_POST['confirm-username'];
            $password = $_POST['confirm-password'];
            $fullname = $_POST['confirm-fullname'];
            $email = $_POST['confirm-email'];
            $phone = $_POST['confirm-phone'];
            $date = $_POST['confirm-date'];
            if ($a == $b) {
                $sql = "INSERT INTO users (`username`, `fullname`, `email`, `phone`, `date`, `password`) VALUES ('$username','$fullname','$email','$phone','$date','$password')";
                $query = mysqli_query($conn, $sql);
                if ($query != 0) {
                    echo '<script language="javascript">';
                    echo 'alert("Signup Successful")';
                    echo '</script>';
                    echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
                } else {
                    echo "<p>Signup Fail</p>";
                }
            } else {
                echo "<p>Invalid email verification code, please check email</p>";
            }
        }
        ?>
    </div>

    <script>

        $(document).ready(function() {
            $("#btnSend").click(function() {
                $("#formSend").hide();
                setCountDown();
            });
        });

        function setCountDown() {
            var timeLeft = 45;
            var timerId = setInterval(countdown, 1000);
            var elem = document.getElementById('some_div');

            function countdown() {
                if (timeLeft == -1) {
                    clearTimeout(timerId);
                    location.href = 'index.php';
                } else {
                    elem.innerHTML = timeLeft + ' seconds remaining';
                    timeLeft--;
                }
            }
        }
    </script>
</body>

</html>