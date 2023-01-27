
<?php
require_once 'db.php';

// Get top rated artworks and user information
$query = "SELECT artworks.*, users.username FROM artworks JOIN users ON artworks.user_id = users.id WHERE artworks.status = 'approved' ORDER BY artworks.rating DESC LIMIT 10";
$top_rated_artworks = mysqli_query($conn, $query);

// Get users with the most approved submissions
$query = "SELECT users.*, COUNT(artworks.id) AS submission_count FROM users JOIN artworks ON artworks.user_id = users.id WHERE artworks.status = 'approved' GROUP BY users.id ORDER BY submission_count DESC LIMIT 10";
$top_users = mysqli_query($conn, $query);

?>
<h1>Leaderboard</h1>

<h2>Top Rated Artworks</h2>
<table>
  <tr>
    <th>Title</th>
    <th>Artist</th>
    <th>Rating</th>
  </tr>
  <?php while ($artwork = mysqli_fetch_assoc($top_rated_artworks)) { ?>
    <tr>
      <td><?php echo $artwork['title']; ?></td>
      <td><?php echo $artwork['username']; ?></td>
      <td><?php echo $artwork['rating']; ?></td>
    </tr>
  <?php } ?>
</table>
<h2>Top Users</h2>
<table>
  <tr>
    <th>Username</th>
    <th>Approved Submissions</th>
  </tr>
  <?php while ($user = mysqli_fetch_assoc($top_users)) { ?>
    <tr>
      <td><?php echo $user['username']; ?></td>
      <td><?php echo $user['submission_count']; ?></td>
    </tr>
  <?php } ?>
</table>