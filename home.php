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
                $query = "SELECT * FROM artworks WHERE status = 'approved' ORDER BY created_at DESC LIMIT 6";
                $result = mysqli_query($conn, $query);
                while($artwork = mysqli_fetch_assoc($result)) {
                    echo '<div class="card">';
                    echo '<img src="images/' . $artwork['image'] . '" alt="' . $artwork['title'] . '">' . $artwork['title'] . '</li>';
                    echo '<h3>' . $artwork['title'] . '</h3>';
                    echo '<p>By ' . $artwork['artist'] . '</p>';
                    echo '</div>';
                }
            ?>





        </div>
    </div>
