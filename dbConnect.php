<?php
    $dbname = "project";
    
    $conn = mysqli_connect("127.0.0.1", "root","", $dbname,'3306');

    
    if ($conn -> connect_errno) {

      echo "Failed to connect to MySQL: " . $conn->connect_error;

      exit();

    }
      
    
    ?>



