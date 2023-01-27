<?php
    session_start();
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        header('Location: index.php');
        exit();
    }

    include 'db.php';
    $minRating = 3.5;
    $query = "SELECT * FROM artworks WHERE rating >= $minRating AND status = 'pending'";
    $result = mysqli_query($conn, $query);
    $submissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Moderation Panel</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Rating</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($submissions as $submission): ?>
        <tr>
            <td><?php echo $submission['title']; ?></td>
            <td><?php echo $submission['artist']; ?></td>
            <td><?php echo $submission['rating']; ?></td>
            <td>
                <button onclick="approve(<?php echo $submission['id']; ?>)">Approve</button>
                <button onclick="reject(<?php echo $submission['id']; ?>)">Reject</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    function approve(id) {
        // Send an AJAX request to update the submission's status to "approved"
    }

    function reject(id) {
        // Send an AJAX request to update the submission's status to "rejected"
    }
</script>



