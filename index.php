<?php
    session_start();

    // Include necessary files
    include 'db.php';
    include 'functions.php';

    

    // Get the current page
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // Check if the user is logged in
    $loggedIn = isset($_SESSION['user_id']);

    // Handle login and signup
    if(isset($_POST['username']) && isset($_POST['password'])) {
        handleLogin();
    }
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        handleSignup();
    }

    // Get the content for the current page
    $content = getContent($page);

    // Include the header
    include 'header.php';

    // Include the content
    include $content;

    // Include the footer
    include 'footer.php';

?>