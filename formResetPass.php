<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<body>
    <?php
    require "connect.php";

    $username = ''; // tái sd
    $code = ''; // tái sd

    if (isset($_POST['f-username']) && isset($_POST['f-email'])) {
        $username = $_POST['f-username'];
        $email = $_POST['f-email'];
        $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `email`='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
            $code = substr(md5(uniqid(mt_rand(), true)), 0, 5);
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
            $mail->Subject = 'TDTU Classroom - Reset Password';
            $content = "<div>Password change confirmation code: </div><br><span style='background-color: yellow; font-size:150%;'>".  $code ."</span>";
            $mail->Body = $content;
            $mail->AddAddress($email);
            $mail->Send();
            // !SEND CODE
        } else {
            echo "
            <script>
                alert('Account does not exist');
                window.location = 'index.php';
            </script>
            ";
        }
    }
    ?>

    <div class="container" style="">
        <p>A password has been sent to your email, please enter it correctly to change a new password</p>
        <form class="form-inline" action="" method="post">
            <input type="hidden" name="username" value="<?php echo $username ?>">
            <input type="hidden" name="h-code" value="<?php echo $code ?>">
            <input class="form-control mr-3" type="text" name="code" placeholder="Enter code">
            <input class="form-control mr-3" type="password" name="newpass" placeholder="Enter new password" minlength="8">
            <button class="btn btn-primary" type="submit" name="resetpass">Reset</button>
        </form>
        <br>
        <p id="countdown"></p>
    </div>

    <?php
    if (isset($_POST['resetpass'])) {
        if ($_POST['code'] == $_POST['h-code']) {
            $username = $_POST['username'];
            $newpass = md5($_POST['newpass']);
            mysqli_query($conn, "UPDATE `users` SET `password`='$newpass' WHERE `username`='$username'");

            echo "
                <script>
                    alert('Successful');
                    window.location = 'index.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('The code is incorrect');
                    window.location = 'index.php';
                </script>
                ";
        }
    }
    ?>

    <script>
        var timeLeft = 45;
        var timerId = setInterval(countdown, 1000);
        var elem = document.getElementById('countdown');

        function countdown() {
            if (timeLeft == -1) {
                clearTimeout(timerId);
                window.location = 'index.php';
            } else {
                elem.innerHTML = timeLeft + ' seconds remaining';
                timeLeft--;
            }
        }
    </script>
</body>

</html>