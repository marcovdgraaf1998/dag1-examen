<?php
    $db_hostname = 'localhost';
    $db_database = '84999_examen';
    $db_username = 'ex84999';
    $db_password = 'c8jMRpW%4d';

    $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    # Check voor errors
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>