<?php

//connect to database
$dbServer = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "nmucard";
$conn= mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
    if (!$conn) {
        die("Database connection failed whith the following error: ".mysqli_connect_error());
            # code...
    }
