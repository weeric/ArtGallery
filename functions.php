<?php

function getContent($page) {
    switch ($page) {
        case 'home':
            return 'home.php';
        case 'leaderboard':
            return 'leaderboard.php';
        case 'dashboard':
            return 'dashboard.php';
        case 'moderation':
            return 'moderation.php';
        case 'featured':
            return 'featured.php';
        case 'submit':
            return 'submit.php';
        case 'login':
            return 'login.php';
        case 'manage-users':
            return 'manage-users.php';
        case 'manage-artworks':
            return 'manage-artworks.php';
        case 'settings':
            return 'settings.php';
        case 'signup':
            return 'signup.php';
        case 'logout':
            session_destroy();
            header('Location: index.php');
            exit;
        default:
            return '404.php';
    }
}

function handleLogin() {
    global $conn;
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT id, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }

    return false;
}




function handleSignup() {
    global $conn;
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        // Insert the user's email into the tokens table with a default token balance of 0
        $query = "INSERT INTO tokens (email, token_balance) VALUES ('$email', 0)";
        mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

// function to get the role of a user
function getRole($user_id) {
    global $conn;
    $query = "SELECT role FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    return $user['role'];
}

function getUser($user_id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function getAllArtworks() {
    global $conn;
    $query = "SELECT * FROM artworks";
    $result = mysqli_query($conn, $query);
    $artworks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $artworks;
}

function getArtworksByArtist($artist_id) {
    global $conn;
    $query = "SELECT * FROM artworks WHERE artist_id = $artist_id";
    $result = mysqli_query($conn, $query);
    $artworks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $artworks;
}

function getFeaturedArtworks() {
    global $conn;
    $query = "SELECT * FROM artworks WHERE featured = 1";
    $result = mysqli_query($conn, $query);
    $artworks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $artworks;
}

// Get all approved artworks
$query = "SELECT * FROM artworks WHERE status = 'approved'";
$approved_artworks_result = mysqli_query($conn, $query);

// Convert the result to an array
$approved_artworks = mysqli_fetch_all($approved_artworks_result, MYSQLI_ASSOC);

// Convert the array to a json
$approved_artworks_json = json_encode($approved_artworks);

