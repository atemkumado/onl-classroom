<div class="col-md-3" name="side-bar">
    <ul class="list-group">
        <li class="list-group-item">
            <a class="nav-link" href="home.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                Classroom
            </a>
        </li>
        <li class="list-group-item">
            <a class="nav-link" href="todo.php">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                To-do
            </a>
        </li>
        <li class="list-group-item ">
            <p>Registered:</p>
            <div class="overflow-auto">
                <?php
                require("connect.php");
                $sql = "SELECT * FROM course WHERE id in ( SELECT course_id FROM user_course WHERE user_id = $user_id )";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="d-flex bd-highlight mb-2 pl-2">
                        <img class="rounded-circle" src="https://via.placeholder.com/50/3498DB/FFFFFF/?text=<?php echo $row['name'][0] ?>" alt="Teacher Image" style="width: 40px; height:40px">
                        <a class="nav-link card-title" href="classes.php?course_id=<?php echo $row["id"] ?>"><?php echo $row['name'] ?></a>
                    </div>
                <?php } ?>
            </div>
        </li>
        <li class="list-group-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-archive" aria-hidden="true"></i>
                Storage
            </a>
        </li>
        <li class="list-group-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-cog" aria-hidden="true"></i>
                Setting
            </a>
        </li>
    </ul>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Features are being updated
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>