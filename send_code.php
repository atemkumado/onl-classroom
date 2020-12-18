<?php
$code = $_POST['send_code'];
$email = $_POST['send_email'];

require_once('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML(true);
$mail->Username = 'longnt26042000@gmail.com';
$mail->Password = 'longpro12';
$mail->SetFrom('no-reply@tdtu.edu.vn', 'Admin');
$mail->Subject = 'TDTU Classroom';
$mail->Body = 'Enter your confirmation code to create your account: '. $code;
// $mail->AddAddress('hongtoan20042000@gmail.com');
$mail->AddAddress($email);

$mail->Send();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
</head>

<body>
    <script>
        window.close();
    </script>
</body>

</html>