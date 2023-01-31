<?php

$user_id = $_SESSION['user_id'];
$user_role = getRole($user_id);

if ($user_role != 'admin' && $user_role != 'artist') {
    header('Location: index.php');
    exit;
}

    include 'db.php';
    $minRating = 0;
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
                <button onclick="deleteArtwork(<?php echo $submission['id']; ?>)">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<h2>Set Feature</h2>
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
                <button onclick="feature(<?php echo $submission['id']; ?>)">Feature</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>




<script>
    function approve(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update-status.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.response);
            if(response.status === 'success') {
                location.reload();
            } else {
                alert(response.message);
            }
        }
    }
    xhr.send('id=' + id + '&status=approved');
}

function reject(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update-status.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.response);
            if(response.status === 'success') {
                location.reload();
            } else {
                alert(response.message);
            }
        }
    }
    xhr.send('id=' + id + '&status=rejected');
}

function deleteArtwork(id) {
var xhr = new XMLHttpRequest();
xhr.open('POST', 'delete-artwork.php', true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.onreadystatechange = function() {
if (xhr.readyState === 4 && xhr.status === 200) {
var response = JSON.parse(xhr.response);
if(response.status === 'success') {
location.reload();
} else {
alert(response.message);
}
}
}
xhr.send('id=' + id);
}

</script>