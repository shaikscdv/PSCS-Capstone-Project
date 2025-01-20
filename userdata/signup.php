<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Update your DB password
$dbname = "finalyear";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $emergency_question = $_POST['emergency_question'];
    $emergency_answer = $_POST['emergency_answer'];

    $sql = "INSERT INTO users (name, email, password, emergency_question, emergency_answer) 
            VALUES ('$name', '$email', '$password', '$emergency_question', '$emergency_answer')";

    if ($conn->query($sql) === TRUE) {
        header("Location:http://localhost/finalyear/userdata/signin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
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

        /* Styling for text and password inputs */
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

        /* Styling specifically for email input */
        .form-container input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 0.95rem;
            background-color: #F4F6F7; /* Light grey background */
        }

        .form-container input[type="email"]:focus {
            border-color: #3498DB;
            background-color: #FFFFFF; /* White background on focus */
            box-shadow: 0px 0px 4px rgba(52, 152, 219, 0.5);
        }

        /* Styling for select dropdown */
        .form-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 0.95rem;
            background-color: #F4F6F7; /* Light grey background */
            color: #2C3E50;
        }

        .form-container select:focus {
            border-color: #3498DB;
            background-color: #FFFFFF; /* White background on focus */
            box-shadow: 0px 0px 4px rgba(52, 152, 219, 0.5);
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

        /* Header */
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
        <h1>User Signup</h1>
        <form method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="emergency_question">Select Emergency Question</label>
            <select id="emergency_question" name="emergency_question" required>
                <option value="" disabled selected>Select a question</option>
                <option value="Your pet''s name">What is your pet's name?</option>
                <option value="Your mother's maiden name">What is your mother's maiden name?</option>
                <option value="Your favorite food">What is your favorite food?</option>
                <option value="The city you were born in">In which city were you born?</option>
                <option value="The name of your first school">What was the name of your first school?</option>
                <option value="Your childhood best friend">Who was your childhood best friend?</option>
            </select>

            <label for="emergency_answer">Answer</label>
            <input type="text" id="emergency_answer" name="emergency_answer" required>

            <button type="submit">Signup</button>
        </form>

        <div class="form-footer">
            <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </div>
</div>
</body>
</html>
