<?php 
    ob_start();
    function displayComment($comment_id,$activity_id,$current_user_id){
        require("connect.php");
        $sql = "SELECT * FROM comment WHERE id = $comment_id"; //GET COMMENT DATA 
        $result = mysqli_query($conn,$sql);
        if ($result === FALSE){
            echo "FALSE";
        }else{ 
            $row = $result->fetch_assoc();
            $content = $row["content"];
            $date = strtotime($row["date"]);
            $date = date("d M",$date); //convert String to Date type
            $commented_user = $row["user_id"];

            $sql = "SELECT * FROM users WHERE id = $commented_user"; //GET name of comment's user 
            $result = mysqli_query($conn,$sql);
            if ($result === FALSE){
                echo "FALSE";
            }else{ 
                $row = $result->fetch_array();
                $username = $row['fullname'];
                $useravatar = $row['avatar'];
            }
        } 
        

        ?>
        <div class="card d-flex mt-3" >
            <div class="card-body py-1 pb-3 pt-3"  style="position:relative">
                <!-- tạo tên và ngày post tương tự như trên -->
                <table>
                    <tr>
                        <td><img class="rounded-circle mr-3" src="<?php echo $useravatar ?>" alt="Teacher Image" style="width:40px; height:40px;"> </td>
                        <td>
                             <h6><?php echo $username ?> <small><?php echo $date ?></small></h6>
                            <p class="card-text"><?php echo $content ?></p>
                        </td>
                        <?php 
                        if ($commented_user == $current_user_id) // check if comment is made by current user, user will allow to delete
                        { ?> 
                            <td>
                            <form style="position:absolute; right:0; top:0" method="POST">
                                <input type="hidden" value="<?php echo $comment_id ?>" name="comment_id">
                                <button class="btn m ml-auto" name="deleteComment">x</small></button> 
                            </form>  
                            </td>
                        <?php } ?>
                    </tr>

                </table>
            </div>
        </div>
        <?php
    }

    function delComment($comment_id){
        require("connect.php");
        $sql = "DELETE FROM user_comment WHERE comment_id = $comment_id";
        $result = mysqli_query($conn,$sql);
        if($result === FALSE){
            echo "COMMENT DELETE ERROR 1: ".$conn->error;
        }else{
            $sql = "DELETE FROM activity_comment WHERE comment_id = $comment_id";
            $result = mysqli_query($conn,$sql);
            if($result === FALSE){
                echo "COMMENT DELETE ERROR 2: ".$conn->error;
            }else{
                $sql = "DELETE FROM comment WHERE id = $comment_id";
                $result = mysqli_query($conn,$sql);
                if($result === FALSE){
                    echo "COMMENT DELETE ERROR 3: ".$conn->error;
                }
            }
        }
    }
    //DELETE COMMENT
    if(isset($_POST["deleteComment"])){
        $comment_id= $_POST["comment_id"];
        delComment($comment_id);
    }
   
?>
    