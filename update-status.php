<?php
include 'db.php';

// Get the ID and status from the POST request
$id = $_POST['id'];
$status = $_POST['status'];


// Update the status in the database
$query = "UPDATE artworks SET status = '$status' WHERE id = $id";
$result = mysqli_query($conn, $query);

// Check if the update was successful
if ($result) {
    echo json_encode(['status'=>'success']);
} else {
    echo json_encode(['status'=>'error','message'=>mysqli_error($conn)]);
}
?>