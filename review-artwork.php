<?php
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $artwork_id = $_GET['id'];
    $review = $_POST['review'];
    $query = "INSERT INTO reviews (username, artwork_id, review) VALUES ('$username', '$artwork_id', '$review')";
    mysqli_query($conn, $query);
    header('location: index.php?page=artwork-detail&id=' . $artwork_id);
}
?>
<h2>Write a review for this artwork</h2>
<form action="" method="post">
    <textarea name="review"></textarea>
    <input type="submit" name="submit" value="Submit">
</form>

