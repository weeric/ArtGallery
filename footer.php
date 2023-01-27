<footer>
  <div class="footer-links">
    <a href="about.php">About</a>
    <a href="exhibitions.php">Exhibitions</a>
    <a href="artists.php">Artists</a>
    <a href="contact.php">Contact</a>
  </div>

  <p>Copyright © <?php echo date('Y'); ?> Art Gallery</p>
</footer>


    <script>
    // Check if the user is logged in
    var loggedIn = <?php echo json_encode($loggedIn); ?>;
    var role = <?php echo json_encode(getRole($_SESSION['user_id'])); ?>;
    if (loggedIn) {
        // Show the "Submit Art" and "Logout" links
        document.getElementById("submit-art-link").style.display = "block";
        document.getElementById("logout-link").style.display = "block";
        if(role == 'admin' || role == 'moderator'){
            document.getElementById("admin-panel-link").style.display = "block";
            document.getElementById("approve-art-link").style.display = "block";
        }
        // Hide the "Login" and "Signup" links
        document.getElementById("login-link").style.display = "none";
        document.getElementById("signup-link").style.display = "none";
    } else {
        // Show the "Login" and "Signup" links
        document.getElementById("login-link").style.display = "block";
        document.getElementById("signup-link").style.display = "block";
        // Hide the "Submit Art" and "Logout" links
        document.getElementById("submit-art-link").style.display = "none";
        document.getElementById("logout-link").style.display = "none";
        document.getElementById("admin-panel-link").style.display = "none";
        document.getElementById("approve-art-link").style.display = "none";
    }
</script>



<script src="js/fade.js"></script>
</body>
</html>

