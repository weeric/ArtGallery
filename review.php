<?php 

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include database connection file
include_once "db.php";

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	// Prepare variables for the SQL statement
	$user_id = $_SESSION["id"];
	$artwork_id = $_POST["artwork_id"];
	$rating = $_POST["rating"];
	$review = $_POST["review"];
	
	// Prepare the SQL statement
	$sql = "INSERT INTO reviews (user_id, artwork_id, rating, review) VALUES (?, ?, ?, ?)";
	
	if($stmt = mysqli_prepare($link, $sql)){
		
		// Bind variables to the prepared statement
		mysqli_stmt_bind_param($stmt, "iiis", $user_id, $artwork_id, $rating, $review);
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt)){
			header("location: index.php");
			exit();
		} else{
			echo "Something went wrong. Please try again later.";
		}
	}
	
	// Close the prepared statement
	mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Leave a Review</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Leave a Review</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<input type="hidden" name="artwork_id" value="<?php echo $_GET["id"]; ?>">
			<div>
				<label for="rating">Rating:</label>
				<select name="rating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div>
				<label for="review">Review:</label>
				<textarea name="review"></textarea>
            </div>
			<input type="submit" value="Submit">
		</form>
		<a href="index.php">Go back to the home page</a>
	</div>
</body>
</html>