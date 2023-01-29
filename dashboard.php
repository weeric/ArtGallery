<?php

$user_id = $_SESSION['user_id'];
$user_role = getRole($user_id);

if ($user_role != 'admin' && $user_role != 'artist') {
    header('Location: index.php');
    exit;
}

$user = getUser($user_id);
$username = $user['username'];

if ($user_role == 'admin') {
    $artworks = getAllArtworks();
} else {
    $artworks = getArtworksByArtist($user_id);
}

?>
<h1>Welcome, <?php echo $username; ?></h1>
<h2>Your Artworks</h2>

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
        <td>
        <?php 
        $ext = pathinfo($artwork['image'], PATHINFO_EXTENSION);
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
                echo '<img src="images/'.htmlspecialchars($artwork['image'], ENT_QUOTES).'" alt="'.$artwork['title'].'" width="100">';
                break;
            case 'mp4':
                echo '<div class="card-video">
                        <video width="100" height="100" controls>
                            <source src="images/'.htmlspecialchars($artwork['image'], ENT_QUOTES).'" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                      </div>';
                break;
            default:
                echo 'File type not supported';
                break;
        }
        ?>
        </td>
        <td><?php echo $artwork['description']; ?></td>
        <td>
            <?php if ($user_role == 'admin' || $user_id == $artwork['artist_id']): ?>
                <a href="edit-artwork.php?id=<?php echo $artwork['id']; ?>">Edit</a>
                <a href="delete-artwork.php?id=<?php echo $artwork['id']; ?>" onclick="return confirm('Are you sure you want to delete this artwork?');">Delete</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>