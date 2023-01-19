<?php
$servername = "localhost";
$username = "manager";
$password = "manager";

// Create connection
$conn = mysqli_connect($servername, $username, $password,'todos');

// Check connection
if (!$conn) {
  echo "Connection failed: " . mysqli_connect_error();
}
?>