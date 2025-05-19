<?php
// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database");

// Get ID from AJAX request
$id = $_GET['id'];

// Fetch data from database
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Return HTML response
echo "<h3>" . $row['name'] . "</h3>";
echo "<p>Email: " . $row['email'] . "</p>";
?>