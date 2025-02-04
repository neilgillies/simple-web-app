<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simple_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>" . $row["message"] . " - " . $row["created_at"] . "</p>";
    }
} else {
    echo "No messages found.";
}

$conn->close();
?>