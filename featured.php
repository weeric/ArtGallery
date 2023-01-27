<h2>Featured Artworks</h2>
<div class="card-container">
    <?php
        // Get featured artworks from the database
        $artworks = getFeaturedArtworks();
        foreach ($artworks as $artwork) {
            echo '<div class="card">
                <img src="images/' . $artwork['image'] . '" alt="' . $artwork['title'] . '">
                <div class="card-content">
                <h3>' . $artwork['title'] . '</h3>
                <p>' . $artwork['artist'] . '</p>
                </div>
            </div>';
        }
    ?>
</div>