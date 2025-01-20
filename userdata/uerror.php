<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Update with your DB password
$dbname = "finalyear"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_title = $_POST['error_title'];
    $error_date = $_POST['error_date'];
    $error_message = $_POST['error_message'];

    // Insert error data into the database
    $sql = "INSERT INTO error_logs (error_title, error_date, error_message) VALUES ('$error_title', '$error_date', '$error_message')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Error log has been added successfully!";
        $messageType = "success";  // Success message
    } else {
        $message = "Error: " . $conn->error;
        $messageType = "error";  // Error message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Error Log</title>
  <style>
    /* Base styles */
    .body1 {
        background-color: #EAF2F8;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Form Container */
    .form-container {
        width: 100%;
        max-width: 400px;
        background-color: #FFFFFF;
        border-radius: 8px;
        padding: 20px 30px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        color: #2C3E50;
        margin-bottom: 20px;
    }

    .form-container label {
        display: block;
        font-size: 0.9rem;
        font-weight: bold;
        color: #2C3E50;
        margin-bottom: 5px;
    }

    .form-container input[type="text"],
    .form-container input[type="date"],
    .form-container textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #BDC3C7;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="date"]:focus,
    .form-container textarea:focus {
        border-color: #5D9CEC;
        outline: none;
        box-shadow: 0px 0px 4px rgba(93, 156, 236, 0.5);
    }

    .form-container button {
        width: 100%;
        padding: 12px;
        background-color: #5D9CEC;
        color: #FFFFFF;
        font-size: 1rem;
        margin-bottom: 20px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20;}


       

    .form-container button:hover {
        background-color: #3C77B6;
    }

    /* Message Box Styles */
    .message {
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        border-radius: 5px;
        font-size: 1rem;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
    }
    .blog2{
        margin-left: 150px;
        width: 100%;
        padding: 12px;
        background-color: #5D9CEC;
        color: #FFFFFF;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease; 
    }
  </style>
</head>
<body class="body1">
  <div class="form-container">
    <?php
    if (isset($message)) {
        // Display the success or error message
        echo "<div class='message " . $messageType . "'>" . $message . "</div>";
    }
    ?>
    <h1>Add Error Log</h1>
    <form action="uerror.php" method="POST">
        <label for="error_title">Error Title</label>
        <input type="text" id="error_title" name="error_title" required>

        <label for="error_date">Error Date</label>
        <input type="date" id="error_date" name="error_date" required>

        <label for="error_message">Error Message</label>
        <textarea id="error_message" name="error_message" rows="5" required></textarea>

        <button type="submit">Add Error</button>
        <a href="http://localhost/finalyear/userdata/udash.php" class="blog2">dashboard</a>
    </form>
  </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
