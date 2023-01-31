<?php

include 'db.php';

$id = intval($_POST['id']);

$query = "DELETE FROM artworks WHERE id = $id";

if (mysqli_query($conn, $query)) {
    $response = [
        'status' => 'success',
        'message' => 'Artwork deleted successfully.'
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error deleting artwork.'
    ];
}

echo json_encode($response);

mysqli_close($conn);

?>