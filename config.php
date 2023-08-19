<?php
    define('HOSTNAME', "localhost");
    define('USERNAME', "root");
    define('PASSWORD', "");
    define('DATABASE', "crud_task_manager");

    //connection to database
    $connection = mysqli_connect(HOSTNAME, USERNAME , PASSWORD, DATABASE);

    if(!$connection){
        die("Connection failed: ");
    }
    // else{
    //     echo 'Connected successfully';
    // }

?>