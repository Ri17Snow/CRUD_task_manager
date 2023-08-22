<?php session_start()?>
<?php include('config.php')?>
<?php include('header.php')?>


<?php
    if(isset($_GET['id'])){
        $id = $_GET["id"];

        //check if the task with this ID has already been saved
        $checkQuery = "SELECT COUNT(*) AS count FROM saved_tasks WHERE `task_id` = '$id'";
        $checkResult = mysqli_query($connection, $checkQuery);
        $checkRow = mysqli_fetch_assoc($checkResult);

        if($checkRow['count'] === '0'){ // if task is not saved already
            
            // Select all column in TASKS
            $query = "SELECT * FROM tasks WHERE `id` = '$id'";
    
            // Execute the query
            $result = mysqli_query($connection, $query);

            
            if(!$result){
                die("Query Failed".mysqli_error($connection));
            }
            else{
                $row = mysqli_fetch_assoc($result);
                $_SESSION['saveMessage'] = "Task successfully saved!";
                header("Location: index.php");
            
                // Insert the data into a new table (e.g., saved_tasks)
                $insertQuery = "INSERT INTO saved_tasks (`task_id`, `title`, `description`, `due_date`) VALUES ('$id', '{$row['title']}', '{$row['description']}', '{$row['due_date']}')";

                $insertResult = mysqli_query($connection, $insertQuery);
            
                if(!$insertResult){
                     die("Insertion Failed".mysqli_error($connection));
                }
            }
        }
        
    }
?>

    <h3 class="text-center">Done Tasks</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //Fetch and display saved data from the new table
                $savedQuery = "SELECT * FROM saved_tasks";
                $savedResult = mysqli_query($connection, $savedQuery);

                while($savedRow = mysqli_fetch_assoc($savedResult)){
                    echo "<tr>
                            <td>{$savedRow['task_id']}</td>
                            <td>{$savedRow['title']}</td>
                            <td>{$savedRow['description']}</td>
                            <td>{$savedRow['due_date']}</td>
                          </tr>  
                    ";
                }
            ?>
        </tbody>
    </table>
    <!--Done button-->
    <div class="text-center">
        <a href="index.php" class="btn btn-primary float-end btn-lg">DONE</a>
    </div>
    

<?php include('footer.php')?>