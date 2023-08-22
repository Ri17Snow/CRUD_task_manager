<?php session_start()?>
<?php include('config.php')?>
<?php include('header.php')?>

<?php

    if(isset($_GET['id'])){
        $id = $_GET["id"];
        
        //select all column in TASKS
        $query = "SELECT * FROM tasks WHERE `id` = '$id'";

        //execute the query
        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query Failed".mysqli_error($connection));
        }
        else{
            $row=mysqli_fetch_assoc($result);
        }
    }
?>

<?php

    if(isset($_POST['update_tasks'])){
       
        if(isset($_GET['id'])){
            $id = $_GET['id']; 
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];

        $query =  "UPDATE `tasks` SET `title` = '$title', `description` = '$description', `due_date` = '$due_date' WHERE `id` = '$id'";

        $result = mysqli_query($connection, $query);

        if(!$result){
            die('Query Failed'.mysqli_error($connection));
        }
        else{
            $_SESSION['updateMessage'] = "Task successfully updated!";
            header("Location: index.php");
        }
    }
?>

    <form action="update.php?id=<?php echo $id;?>" method="post">
        <div class="form-group mb-2">
            <label class="fs-3 fw-semibold">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>">
        </div>
        <div class="form-group mb-2">
            <label class="fs-3 fw-semibold">Description</label>
            <input type="text" name="description" class="form-control" value="<?php echo isset($row['description']) ? $row['description'] : ''; ?>">
        </div>
        <div class="form-group mb-2">
            <label class="fs-3 fw-semibold">Due Date</label>
            <input type="text" name="due_date" class="form-control" value="<?php echo isset($row['due_date']) ? $row['due_date'] : ''; ?>">
        </div>
        <input type="submit" id="update-btn" class="btn btn-success mt-2 float-end" name="update_tasks" value="UPDATE">
    </form>

<?php include('footer.php')?>
