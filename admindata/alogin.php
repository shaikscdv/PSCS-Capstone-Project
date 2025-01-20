<?php
// Hardcoded credentials for testing purposes
$valid_email = "admin@example.com";  // Replace with actual email
$valid_password = "admin123";        // Replace with actual password

$login_message = '';  // Variable to store login status message

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if entered credentials match the predefined ones
    if ($username == $valid_email && $password == $valid_password) {
        // Redirect to the Admin Dashboard page if credentials are valid
        header("Location:http://localhost/finalyear/admindata/adash.php");  // Redirect to the admin dashboard
        exit();  // Terminate further script execution to ensure the redirect happens
    } else {
        $login_message = "Invalid credentials. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <style>
        /* General Styles */
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
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
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

        /* Footer Text */
        .form-footer {
            text-align: center;
            font-size: 0.9rem;
            color: #7F8C8D;
            margin-top: 15px;
        }

        .form-footer a {
            color: #5D9CEC;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .header {
            background: linear-gradient(90deg, #274a78, #3c5d9b);
            color: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .logo {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #ffffff;
        }

        .header .search-bar {
            display: flex;
            align-items: center;
        }

        .header input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
            transition: all 0.3s ease;
        }

        .header input[type="text"]:focus {
            border-color: #80aee0;
            box-shadow: 0 0 5px rgba(128, 174, 224, 0.7);
        }

        .header button {
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            background-color: #80aee0;
            color: white;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
            transition: background-color 0.3s ease;
        }

        .header button:hover {
            background-color: #5f90c2;
        }

        .header a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #d7e2ee;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">CraftCove</div>
    <div>
        <a href="http://localhost/finalyear/mainpage/Home.php">HOME</a>
        <a href="http://localhost/finalyear/blog/blog.php">BLOG</a>
    </div>
</div>

<div class="body1">
    <div class="form-container">
        <h1>Admin Sign in</h1>
        <form method="POST">
            <label for="username">Email:</label>
            <input type="text" id="username" name="username" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Signin</button>
        </form>

        <?php
        // Show login status after submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<p style='color: red; text-align: center;'>" . $login_message . "</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
