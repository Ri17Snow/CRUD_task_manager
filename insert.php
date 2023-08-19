<!--Connect to Database-->
<?php session_start()?>
<?php include('config.php')?>

<?php

    //to check if the add button is pressed
    if(isset($_POST['add_tasks']))

    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    // validation that all field should not be empty
    if(empty($title) || empty($description) || empty($due_date)){
        $_SESSION['warningMessage'] = "All fields are required!";
        header("Location: index.php");
    }
    else{
        $query = "INSERT INTO `tasks`(`title`, `description`, `due_date`)
        VALUES ('$title','$description', '$due_date');";

        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query Failed" .mysqli_error($connection));
        }
        else{
            $_SESSION['insertMessage'] = "Task Added!";
            header("Location: index.php");
        }
    }

?>