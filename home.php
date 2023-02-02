<div class="container">
    <div class="contain">
    <h1>Welcome to the Art Gallery</h1>
    <p>Welcome to our art gallery, where we showcase the work of talented artists from around the world. We are constantly on the lookout for new and exciting pieces to add to our collection, and we would love for you to be a part of it.
If you're an artist who is interested in having your work featured in our gallery, we invite you to submit your art for consideration. We accept all mediums and styles, from painting and sculpture to photography and digital art.</p>
</div>
    <div class="row">
    <div class="col-md-6">



    <div class="col-md-6">
        <h2>Newly Submitted Artworks</h2>
        <div class="card-container">


        <?php
            // Prepare statement to prevent SQL injection
            $query = "SELECT * FROM artworks WHERE status = ? ORDER BY created_at DESC LIMIT 6";
            $stmt = mysqli_prepare($conn, $query);
            // Bind status parameter and execute statement
            mysqli_stmt_bind_param($stmt, "s", $status);
            $status = 'approved';
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0) {
                    while($artwork = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        $file_ext = pathinfo($artwork['image'], PATHINFO_EXTENSION);
                        if ($file_ext == "jpg" || $file_ext == "png") {
                            echo '<img src="images/' . htmlspecialchars($artwork['image'], ENT_QUOTES) . '" alt="' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '">' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '</li>';
                        } elseif ($file_ext == "mp4") {
                            echo '<video src="images/' . htmlspecialchars($artwork['image'], ENT_QUOTES) . '" alt="' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '" controls></video>';
                        }
                        echo '<h3>' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '</h3>';
                        echo '<p>By ' . htmlspecialchars($artwork['artist'], ENT_QUOTES) . '</p>';
                        echo '<a href="artwork.php?id=' . $artwork['id'] . '">View</a>';
                        echo '<a href="review.php?id=' . $artwork['id'] . '">Leave a Review</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No artworks found.</p>';
                }
            } else {
                echo '<p>An error occurred while retrieving the artworks.</p>';
            }
            mysqli_stmt_close($stmt);
        ?>
        </div>



        <div class="col-md-6 featured-artworks">
            <h2>Featured Artworks</h2>
            <div class="card-container">

                <?php
                    // Prepare statement to prevent SQL injection
                    $query = "SELECT * FROM artworks WHERE status = ? AND featured = ? ORDER BY created_at DESC LIMIT 6";
                    $stmt = mysqli_prepare($conn, $query);
                    // Bind status and featured parameters and execute statement
                    mysqli_stmt_bind_param($stmt, "ss", $status, $featured);
                    $status = 'approved';
                    $featured = '1';
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0) {
                            while($artwork = mysqli_fetch_assoc($result)) {
                                echo '<div class="card">';
                                $file_ext = pathinfo($artwork['image'], PATHINFO_EXTENSION);
                                if ($file_ext == "jpg" || $file_ext == "png") {
                                    echo '<img src="images/' . htmlspecialchars($artwork['image'], ENT_QUOTES) . '" alt="' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '">' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '</li>';
                                } elseif ($file_ext == "mp4") {
                                    echo '<video src="images/' . htmlspecialchars($artwork['image'], ENT_QUOTES) . '" alt="' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '" controls></video>';
                                }
                                echo '<h3>' . htmlspecialchars($artwork['title'], ENT_QUOTES) . '</h3>';
                                echo '<p>By ' . htmlspecialchars($artwork['artist'], ENT_QUOTES) . '</p>';
                                echo '<a href="artwork.php?id=' . $artwork['id'] . '">View</a>';
                                echo '<a href="review.php?id=' . $artwork['id'] . '">Leave a Review</a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No artworks found.</p>';
                }
            } else {
                echo '<p>An error occurred while retrieving the artworks.</p>';
            }
            mysqli_stmt_close($stmt);
        ?>
        </div>



    </div>



    