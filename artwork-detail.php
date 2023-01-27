<?php
    $id = $_GET['id'];
    $query = "SELECT * FROM artwork WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
?>
<div class="artwork-detail">
    <h2><?php echo $row['title']; ?></h2>
    <p>By <?php echo $row['artist']; ?></p>
    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
    <p><?php echo $row['description']; ?></p>
    <?php if (isset($_SESSION['username'])) { ?>
        <a href="index.php?page=review-artwork&id=<?php echo $id; ?>">Write a review</a>
    <?php } ?>
</div>