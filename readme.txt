Let's create a very simple web application that allows users to add and view messages. We'll use HTML for the front end, PHP for the server-side scripting, and MySQL for the database.

### Step 1: Set Up the Database
First, create a MySQL database and a table to store the messages.

```sql
CREATE DATABASE simple_app;
USE simple_app;

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Step 2: Create the HTML Form
Next, create an HTML form to allow users to submit messages.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple App</title>
</head>
<body>
    <h1>Submit a Message</h1>
    <form action="submit.php" method="post">
        <textarea name="message" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <h2>Messages</h2>
    <div id="messages">
        <?php include 'view.php'; ?>
    </div>
</body>
</html>
```

### Step 3: Create the PHP Script to Handle Form Submission
Create a PHP script (`submit.php`) to handle the form submission and insert the message into the database.

```php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $sql = "INSERT INTO messages (message) VALUES ('$message')";

    if ($conn->query($sql) === TRUE) {
        echo "New message created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: index.html");
exit();
?>
```

### Step 4: Create the PHP Script to Display Messages
Create a PHP script (`view.php`) to fetch and display the messages from the database.

```php
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
```

### Step 5: Putting It All Together
Make sure you have all the files (`index.html`, `submit.php`, `view.php`) in the same directory and that your web server is configured to serve PHP files.

This is a very basic example, but it should give you a good starting point. If you have any questions or need further assistance, feel free to ask!