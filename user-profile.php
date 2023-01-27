<?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
?>
<div class="user-profile">
    <h2>Welcome, <?php echo $row['username']; ?>!</h2>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>Name: <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
    <a href="index.php?page=edit-profile">Edit Profile</a>
</div>