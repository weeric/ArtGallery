<?php
// Connect to the database
include 'db.php';

// Get all the artworks from the database
$query = "SELECT * FROM artworks";
$result = mysqli_query($conn, $query);

// Get the total number of users
$query = "SELECT COUNT(*) AS total_users FROM users";
$result_users = mysqli_query($conn, $query);
$total_users = mysqli_fetch_assoc($result_users)['total_users'];

// Get the stats on artworks submitted and rejected
$query = "SELECT COUNT(*) AS total, status FROM artworks GROUP BY status";
$result_stats = mysqli_query($conn, $query);
$stats = [];
while ($row = mysqli_fetch_assoc($result_stats)) {
    $stats[$row['status']] = $row['total'];

// Get the total number of users from the database
$query = "SELECT COUNT(*) as total FROM users";
$result_users = mysqli_query($conn, $query);
$users = mysqli_fetch_assoc($result_users);
$total_users = $users['total'];

// Get the average rating of artworks from the database
$query = "SELECT AVG(rating) as average_rating FROM artworks";
$result_rating = mysqli_query($conn, $query);
$rating = mysqli_fetch_assoc($result_rating);
$average_rating = $rating['average_rating'];

// Get the registered users by month from the database
$query = "SELECT COUNT(*) as total, MONTH(created_at) as month, YEAR(created_at) as year FROM users GROUP BY MONTH(created_at), YEAR(created_at)";
$result_users_by_month = mysqli_query($conn, $query);
$users_by_month = [];
while ($row = mysqli_fetch_assoc($result_users_by_month)) {
    $users_by_month[] = [
        'month' => date("F", mktime(0, 0, 0, $row['month'], 10)),
        'year' => $row['year'],
        'total' => $row['total']
    ];
}

}
?>


<!-- Show the total number of users -->
<h3>Total Users: <?php echo $total_users; ?></h3>

<!-- Show the stats on artworks submitted and rejected -->
<h3>Artwork Stats:</h3>
<ul>
    <li>Submitted: <?php echo isset($stats['approved']) ? $stats['approved'] : 0; ?></li>
    <li>Rejected: <?php echo isset($stats['rejected']) ? $stats['rejected'] : 0; ?></li>
</ul>

<!-- Display the total number of registered users and average rating of artworks -->
<div class="stats">
  <p>Total Registered Users: <?php echo $total_users; ?></p>
  <p>Average Rating of Artworks: <?php echo $average_rating; ?></p>
</div>


<!-- Show all the artworks in a card style -->
<h3>All Artworks:</h3>
<div class="row">
    <?php while ($artwork = mysqli_fetch_assoc($result)): ?>
        <div class="col-sm-4">
            <div class="card">
                <img src="images/<?php echo $artwork['image']; ?>" class="card-img-top" alt="Artwork Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $artwork['title']; ?></h5>
                    <p class="card-text">Artist: <?php echo $artwork['artist']; ?></p>
                    <p class="card-text">Status: <?php echo $artwork['status']; ?></p>
                    <a href="index.php?page=edit-artwork&id=<?php echo $artwork['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?page=delete-artwork&id=<?php echo $artwork['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this artwork?');">Delete</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

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




