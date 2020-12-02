<!--* FEATURE: DELETE activity -->
<?php 

if(isset($_GET["activity_id"])){
    $activity_id = $_GET["activity_id"];

    $sql = "DELETE FROM course_activity WHERE activity_id = '$activity_id'" ;
    $result = mysqli_query($conn,$sql);

    $sql = "DELETE FROM activity WHERE id = '$activity_id'";
    $result = mysqli_query($conn,$sql);
    if($result === false){
        echo $conn->error;
    }else{
        header("Location: classes.php");
    }
}

?>    