    <?php
    ob_start();
   

    // INSERT DATA TO D
    if (isset($_POST['rep-submit'])) {
        require("connect.php");
        $user_id = $_POST["user_id"];
        $activity_id = $_POST["activity_id"];

        if (isset($user_id) || isset($activity_id)){
            $comment = $_POST['reply']; // get comment from user
            $sql = "INSERT INTO comment(user_id,content) VALUES ($user_id,'$comment')";
            $result = mysqli_query($conn,$sql);
            if($result === FALSE){
                echo "COMMENT ERROR 1: ".$conn->error;
            }else{
                
                $comment_id = $conn->insert_id;
                $sql= "INSERT INTO user_comment(user_id,comment_id) VALUES ($user_id,$comment_id)";
                $result = mysqli_query($conn,$sql);
                if($result === FALSE){
                    echo "COMMENT ERROR 2: ".$conn->error;
                }else{
                    $sql= "INSERT INTO activity_comment(activity_id,comment_id) VALUES ($activity_id,$comment_id)";
                    $result = mysqli_query($conn,$sql);
                    if($result === FALSE){
                        echo "COMMENT ERROR 3: ".$conn->error;
                    }else{
                        header("Location: classes.php");
                    }
                }
        
            }
        }else{
            die("missing data");
        }
    }
?>
