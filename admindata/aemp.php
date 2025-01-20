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
    // Get form data
    $employee_name = $_POST['employee_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    // Insert employee data into the database
    $sql = "INSERT INTO employees (employee_name, email, password, phone_number) VALUES ('$employee_name', '$email', '$password', '$phone_number')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Employee record added successfully!";
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
  <title>Add Employee - Employee Form</title>
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
    .form-container input[type="email"],
    .form-container input[type="password"],
    .form-container input[type="tel"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #BDC3C7;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="email"]:focus,
    .form-container input[type="password"]:focus,
    .form-container input[type="tel"]:focus {
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
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

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
        margin-top: 10px;
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
    <h1>Add Employee</h1>
    <form action="aemp.php" method="POST">
        <label for="employee_name">Employee Name</label>
        <input type="text" id="employee_name" name="employee_name" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="phone_number">Phone Number</label>
        <input type="tel" id="phone_number" name="phone_number" required>

        <button type="submit">Add Employee</button>
        <button type="submit" class="blog2" action="adisemp.php">SEE Employees</button>
    </form>
  </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
