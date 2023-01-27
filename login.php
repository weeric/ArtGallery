<h2>Login</h2>
<form action="index.php?page=login" method="post">
    <label>Username: <input type="username" name="username"></label>
    <label>Password: <input type="password" name="password"></label>
    <input type="submit" value="Login">
</form>
<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
    $login = handleLogin();
    if($login) {
        header('Location: index.php?page=home');
        exit;
    } else {
        echo '<p>Incorrect login details. Please try again.</p>';
    }
}
?>
<a href="index.php?page=signup">Don't have an account? Sign up here.</a>