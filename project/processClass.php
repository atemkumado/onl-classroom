<?php 
    session_start();
    ob_start();
    require("connect.php");
    
?>
<?php
    include_once ("processActivity.php");
    function getLecturerName($c_id){
        require("connect.php");
        $sql = "SELECT fullname FROM users WHERE id =(SELECT user_id FROM course WHERE id= $c_id) ";
        $result=mysqli_query($conn,$sql);
        $lecturer_row = $result->fetch_assoc();
        return $lecturer_row["fullname"];
    }

    //* FEATURE: DELETE a CLASS 
    if(isset($_POST["delete-class"])){  
        $course_id = $_SESSION["course_id"];  

        $sql = "SELECT activity_id FROM course_activity WHERE course_id = $course_id";
        $result = mysqli_query($conn,$sql);
        if($result === FALSE){
            echo "result1: ".$conn->error;
        }elseif($result->num_rows >0){
         
                while($row = $result->fetch_array()){
                    delActivity($row["activity_id"]);  //DELETE ALL ACTIVITY IN COURSE
                }
                $sql = "DELETE FROM course_activity WHERE course_id = $course_id";
                $result3 = mysqli_query($conn,$sql);
                if($result3 === FALSE){
                    echo "result2: ".$conn->error;
                }else{ 
                    $sql = "DELETE FROM user_course WHERE course_id = $course_id";
                    $result1 = mysqli_query($conn,$sql);
                    if($result1 === FALSE){
                        echo "result3: ".$conn->error;
                    }else{
                        $sql = "DELETE FROM course WHERE id = $course_id";
                        $result = mysqli_query($conn,$sql);
                        if($result === FALSE){
                            echo "result4: ".$conn->error;
                        }else{
                            header("Location: home.php");                           
                        }
                    }
                }
        }


        // $sql = "DELETE FROM course_activity WHERE course_id = $course_id";
        // $result3 = mysqli_query($conn,$sql);
        // if($result3 === FALSE){
        //     echo "result2: ".$conn->error;
        // }else{          
        //     $sql = "DELETE FROM user_course WHERE course_id = $course_id";
        //     $result1 = mysqli_query($conn,$sql);
        //     if($result1 === FALSE){
        //         echo "result3: ".$conn->error;
        //     }else{

                


        //         $sql = "DELETE FROM activity WHERE course_id = $course_id";
        //         $result4 = mysqli_query($conn,$sql);
        //         if($result4 === FALSE){
        //             echo "result4: ".$conn->error;
                // }else{
                    
                                            
    }

    //* FEATURE: EDIT a CLASS 
    
    if(isset($_POST["edit-submit"])){      
        $course_id = $_POST["course_id"];
        $className = $_POST["classname"];
        $gr = $_POST["gr"];
        $shift = $_POST["shift"];

        $sql = "UPDATE course SET name='$className', gr='$gr', shift='$shift' WHERE id='$course_id'";
        $result = mysqli_query($conn,$sql);
        $_SESSION["course_id"]=$course_id;
        
        if($result === FALSE){
            echo "Edit error: ".$conn->error;
        }else{
            
            header("Location: classes.php");                           
            }

    }
    //* FEATURE: JOIN a COURSE 
    if(isset($_POST["join-submit"])){
        $user_id = $_SESSION['user_id'];
        $join_code = $_POST["join_code"];
        $sql =" SELECT id FROM course WHERE $join_code in (SELECT id FROM course) AND ($user_id,$join_code) not in  (SELECT * FROM user_course)";
        $result = mysqli_query($conn,$sql);
        if($result->num_rows == 0){
            echo "CODE IS NOT VALID OR YOUR ARE ALREADY IN COURSE";
        }else{
            
            $sql = "INSERT INTO user_course VALUES($user_id,$join_code)" ;
            $result = mysqli_query($conn,$sql);
            if($result != FALSE){
                header("Location: home.php");
            }else{
                echo '<p> UNVAILABLE CLASSROOM CODE </p>';
            }
        }
    }
    
    //* FEATURE: DELETE a member in course 
    if(isset($_POST["delete-member"])){
        $student_id = $_POST["student_id"];
        $course_id = $_POST["course_id"];
        $sql = "DELETE FROM user_course WHERE user_id = '$student_id' AND course_id = '$course_id'";
        $result = mysqli_query($conn,$sql);
        if($result === FALSE){
            echo '<p> ERROR IN DELETE MEMBER </p>';
        }else{
            header("Location: classes.php");
        }
    }


?>
 