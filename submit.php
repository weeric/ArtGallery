<?php 

$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$username = mysqli_fetch_assoc($result)['username'];


    // Check if user is logged in
    if (!$loggedIn) {
        // Redirect user to login page
        header('Location: index.php?page=login');
        exit;
    }

    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Get the title, image, and description from the form
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $image = $_FILES['image']['name'];
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $user_id = $_SESSION['user_id'];

        // Validate the form data
        if (!$title || !$image) {
            $error = 'Please fill in all required fields.';
        } else {
            // Upload the image to the server
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

            // Insert the artwork into the database
            $query = "INSERT INTO artworks (title, image, description, user_id, artist) VALUES ('$title', '$image', '$description','$user_id','$username')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Redirect user to the home page
                header('Location: index.php');
                exit;
            } else {
                $error = 'There was an error submitting your artwork. Please try again.';
            }
        }
    }
?>

<h1>Submit Artwork</h1>

<?php if (isset($error)) {
    echo '<p>'.$error.'</p>'; } ?>

    <form action="index.php?page=submit" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
    
    <label for="image">Choose Image to Upload:</label>
    <input type="file" name="image" id="image">
    
    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>
    
    <input type="submit" name="submit" value="Submit Artwork">
    </form>