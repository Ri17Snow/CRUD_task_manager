<!--Connect to database-->
<?php session_start()?>
<?php include('config.php');?>
<?php include('header.php')?>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                ADD TASKS
        </button>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th colspan='3'>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                
                //selecting all the column from the database table
                $query =  "SELECT * FROM tasks";

                //executing the query
                $result = mysqli_query($connection, $query);

                if(!$result){
                    die("Query Failed".mysqli_error($connection));
                }
                
                //loop through the results and display each row
                while($row = mysqli_fetch_assoc($result)){
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['due_date']}</td>
                            <td><a href='update.php?id={$row['id']}' class='btn btn-primary'>Update</a></td>
                            <td><a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                            <td><a href='save.php?id={$row['id']}' class='btn btn-success'>Save</a></td>
                        </tr>
                    ";
                }
            ?>

            <!--Display warning message-->
            <?php
                if(isset($_SESSION['warningMessage'])){
                    echo "<h6 class='text-danger text-center  mt-5'>" . $_SESSION['warningMessage'] . "</h6>";
                    unset ($_SESSION['warningMessage']);
                }
            ?>
            <?php
                if(isset($_SESSION['insertMessage'])){
                    echo "<h6 class='text-success text-center  mt-5'>" . $_SESSION['insertMessage'] . "</h6>";
                    unset ($_SESSION['insertMessage']); // clear the message after displaying
                }
            ?>
            <?php
                if(isset($_SESSION['updateMessage'])){
                    echo "<h6 class='text-success text-center mt-5'>" . $_SESSION['updateMessage'] . "</h6>";
                    unset ($_SESSION['updateMessage']); // clear the message after displaying
                }
            ?>
            <?php
                if(isset($_SESSION['deleteMessage'])){
                    echo "<h6 class='text-success text-center mt-5'>" . $_SESSION['deleteMessage'] . "</h6>";
                    unset ($_SESSION['deleteMessage']); // clear the message after displaying
                }
            ?>
            <?php
                if(isset($_SESSION['saveMessage'])){
                    echo "<h6 class='text-success text-center mt-5'>" . $_SESSION['saveMessage'] . "</h6>";
                    unset ($_SESSION['saveMessage']); // clear the message after displaying
                }
            ?>

            <!-- Modal -->
        <form action="insert.php" method="post">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Tasks</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Due Date</label>
                                    <input type="text" name="due_date" class="form-control">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="add_tasks" value="ADD">
                        </div>
                    </div>
                </div>
            </div>
        </form>
   
<?php include('footer.php')?>