<?php

// Include necessary files
include 'db.php';


$id = $_GET['id'];
// Validate and sanitize the id
if(!filter_var($id, FILTER_VALIDATE_INT)) {
    // Redirect to an error page or display an error message
    exit;
}

// Prepare statement to prevent SQL injection
$query = "SELECT * FROM artworks WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
// Bind id parameter and execute statement
mysqli_stmt_bind_param($stmt, "i", $id);
if(mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) > 0) {
        $artwork = mysqli_fetch_assoc($result);
        // Display the artwork details
        ?>
        <div class="artwork">
            <h2><?php echo $artwork['title']; ?></h2>
            <p>By <?php echo $artwork['artist']; ?></p>
            <img src="images/<?php echo $artwork['image']; ?>" alt="<?php echo $artwork['title']; ?>">
            <a href="index.php?page=artwork-detail&id=<?php echo $artwork['id']; ?>">View more</a>
        </div>
        <?php
    } else {
        // Redirect to an error page or display an error message
    }
} else {
    // Redirect to an error page or display an error message
}
mysqli_stmt_close($stmt);