<?php
    // Connect to the database
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'art_gallery';
    $conn = mysqli_connect($host, $user, $password, $db);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
