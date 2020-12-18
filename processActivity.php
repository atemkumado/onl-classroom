<?php
ob_start();
include_once("replyComment.php");

function displayActivity($row, $lecturer_id, $current_user_id)
{
    //$row : data of Activity from database
    require("connect.php");
    require("processComment.php");

    $activity_id = $row["id"];
    $user_id = $row['user_id'];

    $sql = "SELECT * FROM users WHERE id =( SELECT user_id FROM user_activity WHERE  user_id = $user_id AND activity_id = $activity_id )";
    $result = mysqli_query($conn, $sql);
    if ($result === FALSE) {
        echo "FALSE";
    } else {
        $user_row = $result->fetch_assoc();
        $user_name = $user_row["fullname"];
        $user_avatar = $user_row["avatar"];

        echo '
            
                         
            <div class="container ">
                <div class="card d-flex mt-5" >
                    <div class="card-header d-flex "> 
                        
                        <table >
                            <tr>
                                <th>
                                    <input type="hidden" value= ' . $activity_id . ' name ="activity_id">';
        if ($user_id == $lecturer_id) {
            echo '<img class="rounded-circle mr-3 avatar" src="' . $user_avatar . '" >';
        } else {
            echo '<img class="rounded-circle mr-3 avatar" src="' . $user_avatar . '" >';
        }

        echo '
                                </th>
                                <th>
                                    <span class="card-text">' . $user_name . '</span>
                                    <br>
                                    <small>Date post: ' . $row["time"] . '</small>
                                </th>
                            </tr>    
                        </table>
                        <div style="position:absolute; right:0; padding-right:10px">
                           
                                
                                <table>'; //JUST author's activity or teacher allow to use delete button
        if ($lecturer_id == $current_user_id ) {
            echo '
            <tr>';
            if ($lecturer_id == $row['user_id']) {
                echo '
                <td><button class="btn btn-sm text-secondary" name="edit-activity"> <i class="fas fa-edit"></i></button></td>
                ';
            }
            echo '
            <td><button class="btn tb-sm text-secondary" data-toggle="modal" data-target="#delActModal' . $activity_id . '" > <i class="far fa-trash-alt"></i></button></td>  
            </tr>
            ';
        } elseif ($current_user_id==$row['user_id']) {
            echo '
            <tr>
            <td><button class="btn btn-sm text-secondary" name="edit-activity"> <i class="fas fa-edit"></i></button></td>
            <td><button class="btn btn-sm text-secondary"  data-toggle="modal" data-target="#delActModal' . $activity_id . '"> <i class="far fa-trash-alt"></i></button></td>
            </tr>
            ';
        }
        
        echo '
                                </table>
                            
                        </div>
                    </div>'; ?>

        <div>

            <!-- Modal show delete activity-->
            <div class="modal fade" id="delActModal<?php echo $activity_id ?>" tabindex="-1" role="dialog" aria-labelledby="delActModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="delActModalLabel">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                Are you sure you want to delete this activity?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <input type="hidden" value="<?php echo $activity_id ?>" name="activity_id">
                                <button class="btn btn-danger" name="delete-activity" type="submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
        echo '
            <div class="card-body pt-3 pb-4">
                <div class="card-text"> ' . $row["description"] . ' </div>';
        if ($row["file"] != null) {
            $img = $row["file"];
            echo '<br>';
            echo '<a href="' . $img . '">' . $img . '</a>';
        }
        echo '
            </div>';

        //get course of user
        $sql = "SELECT * FROM comment c, activity_comment ac WHERE id = ac.comment_id AND activity_id = $activity_id";
        $result = $conn->query($sql);

        //* FEATURE: DISPLAY all activity of course.

        while ($row = $result->fetch_assoc()) {
            displayComment($row["id"], $row["activity_id"], $current_user_id);
        }

        echo '
                    <form class="mt-3 pl-3 py-2 border rounded" action="./processComment.php" method="POST">
                        <div class="input-group">
                            <img class="rounded-circle mr-3" src="' . $user_avatar . '" alt="User Image" style="width:40px; height:40px;">
                            <input type="hidden" value="' . $activity_id . '" name="activity_id">
                            <input type="hidden" value="' . $current_user_id . '" name="user_id">
                            <input type="text" name="reply" class="form-control border rounded" placeholder="Type your message here..">
                            <button class="btn" type="submit" name="rep-submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </div>
                    </form> 
                </div>               
            </div>';
    }
}


//* FEATURE: UPDATE activity when user requested
if (isset($_POST['activity-submit'])) {
    ob_start();
    $user_id = $_POST["user_id"];
    $course_id = $_POST["course_id"];
    $description = $_POST["description"];

    $target_file = "";
    if ($_FILES["fileToUpload"]["name"] != '') {
        $target_file = "uploads/" . $_FILES["fileToUpload"]["name"];
        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }
    }

    $sql = "INSERT INTO activity(`course_id`,`description`,`file`) VALUES('$course_id', '$description','$target_file') ";
    $result = mysqli_query($conn, $sql);
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $activity_id = $conn->insert_id;

    // set association course_activity
    $linked_sql = "INSERT INTO course_activity( course_id, activity_id) VALUES ('$course_id','$activity_id' )";
    $linked_result = mysqli_query($conn, $linked_sql);

    // set association user_activity
    $linked_sql = "INSERT INTO user_activity( user_id, activity_id) VALUES ('$user_id','$activity_id' )";
    $linked_result = mysqli_query($conn, $linked_sql);
}

function delActivity($activity_id)
{
    require("connect.php");
    $sql = "SELECT comment_id FROM activity_comment WHERE activity_id = $activity_id";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo "ACTIVITY DELETE ERROR0:" . $conn->error;
    } elseif ($result->num_rows > 0) {

        while ($row = $result->fetch_array()) {
            delComment($row["comment_id"]);  //DELETE ALL COMMENT IN ACTIVITY
        }
    }

    $sql = "DELETE FROM course_activity WHERE activity_id = $activity_id "; //DELETE ALL ASSOCIATION of ACTIVITY
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        echo "ACTIVITY DELETE ERROR1:" . $conn->error;
    } else {
        $sql = "DELETE FROM user_activity WHERE activity_id = $activity_id "; //DELETE ALL ASSOCIATION of ACTIVITY
        $result = mysqli_query($conn, $sql);
        if ($result === false) {
            echo "ACTIVITY DELETE ERROR 2:" . $conn->error;
        } else {

            $sql = "DELETE FROM activity WHERE id = $activity_id"; //DELETE ACTIVITY
            $result = mysqli_query($conn, $sql);
            if ($result === false) {
                echo "ACTIVITY DELETE ERROR 3:" . $conn->error;
            }
        }
    }
}
//* FEATURE: DELETE activity               
if (isset($_POST["delete-activity"])) {
    $activity_id = $_POST["activity_id"];
    delActivity($activity_id);
}

?>