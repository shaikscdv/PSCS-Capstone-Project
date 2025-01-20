<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "finalyear";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $num_members = $_POST['num_members'];

    // Prepare SQL query
    $sql = "INSERT INTO registrations (name, email, location, num_members) 
            VALUES ('$name', '$email', '$location', '$num_members')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        /* Your custom styles */
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
            justify-content: center;
            align-items: center;
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
        .form-container input[type="date"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="email"]:focus,
        .form-container input[type="date"]:focus,
        .form-container input[type="number"]:focus {
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

        .form-footer {
            text-align: center;
            font-size: 0.9rem;
            color: #7F8C8D;
            margin-top: 15px;
        }

        /* Header Styling */
        
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

<body >
<div class="header">
    <div class="logo">CraftCove</div>
    <div>
        <a href="http://localhost/finalyear/mainpage/Home.php">HOME</a>
        <a href="http://localhost/finalyear/blog/blog.php">BLOG</a>
    </div>
</div>
    <!-- Header -->
    

    <!-- Event Registration Heading -->
    <div class="body form-container">
        <h1>Event Registration</h1>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <!-- Registration Form -->
        <form action="" method="POST">
            <label for="eventName">Event Name : competition 2</label>
           

            <label for="eventDate">Event Date : 15/01/2025</label>
           
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="location">Location</label>
            <input type="text" id="location" name="location" required>

            <label for="members">Number of Members</label>
            <input type="number" id="members" name="num_members" min="1" required>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
