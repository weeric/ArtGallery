<div class="artwork">
    <h2><?php echo $row['title']; ?></h2>
    <p>By <?php echo $row['artist']; ?></p>
    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
    <a href="index.php?page=artwork-detail&id=<?php echo $row['id']; ?>">View more</a>
</div>