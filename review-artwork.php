<?php

session_start();

// Include necessary files
include 'db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$username = mysqli_fetch_assoc($result)['username'];

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $artwork_id = $_GET['id'];
    $review = $_POST['review'];
    $query = "INSERT INTO reviews (user_id, artwork_id, review) VALUES ('$user_id', '$artwork_id', '$review')";
    mysqli_query($conn, $query);
    header('location: index.php?page=artwork-detail&id=' . $artwork_id);
}
?>
<h2>Write a review for this artwork</h2>
<form action="" method="post">
    <textarea name="review"></textarea>
    <input type="submit" name="submit" value="Submit">
</form>