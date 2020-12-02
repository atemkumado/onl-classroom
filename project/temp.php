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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="card d-flex mt-3 mb-0">
            <div class="card-header d-flex">
                <img class="rounded-circle mr-3" src="https://via.placeholder.com/40x40?text=Avt" alt="Teacher Image" style="width:40px; height:40px;">
                <div class="d-block">
                    <div>Ta Trung Hieu</div>
                    <small>Date post: 20/10/2002</small>
                </div>
            </div>
            <div class="card-body py-1">
                <div class="card-text">Bài tập về nhà dealine dời lại 22/11. có ý kiến thắc mắc gì vui lòng phản hồi qua comment này</div>
                <form class="d-flex" action="" method="POST">
                    <button type="submit" class="btn m ml-auto" name="delete"><small><i class="fa fa-pencil" aria-hidden="true"></i>Edit</small></button>
                    <button type="submit" class="btn" name="reply"><small><i class="fa fa-reply" aria-hidden="true"></i> Reply</small></button>
                    <a href="" class="btn" name="delete"><small><i class="fa fa-trash" aria-hidden="true"></i>Delete</small></a>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['reply'])) {
            $content = require "replyform.php";
            $content = substr($content, 0, strlen($content) - 1);
            echo $content;
        }
        ?>
    </div>
</body>

</html>