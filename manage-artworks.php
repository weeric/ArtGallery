<?php
include 'db.php';
include 'functions.php';

$user_id = $_SESSION['user_id'];
$user_role = getRole($user_id);

if ($user_role != 'admin') {
    header('Location: index.php');
    exit;
}

$artworks = getAllArtworks();

?>
<h1>Manage Artworks</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Image</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($artworks as $artwork): ?>
    <tr>
        <td><?php echo $artwork['title']; ?></td>
        <td><img src="images/<?php echo $artwork['image']; ?>" alt="<?php echo $artwork['title']; ?>" width="100"></td>
        <td><?php echo $artwork['description']; ?></td>
        <td>
            <a href="edit-artwork.php?id=<?php echo $artwork['id']; ?>">Edit</a>
            <a href="delete-artwork.php?id=<?php echo $artwork['id']; ?>" onclick="return confirm('Are you sure you want to delete this artwork?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="add-artwork.php">Add New Artwork</a>

<?php

function getAllArtworks() {
    global $conn;
    $query = "SELECT * FROM artworks";
    $result = mysqli_query($conn, $query);
    $artworks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $artworks;
}

?>